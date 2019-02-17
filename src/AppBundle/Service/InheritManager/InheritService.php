<?php 


namespace AppBundle\Service\InheritManager;

use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\Property;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\LawPosition;
use AppBundle\Entity\PropertyType;
use AppBundle\Entity\LiquidationFiscality;
use AppBundle\Entity\FiscalityAmountBearing;

class InheritService

{


    protected $em;
    private   $container;
    private   $user;
    private   $physicalPersons;
    

    /**
     * Class constructor
     * 
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em        = $em;
        $this->container = $container;
    }

    /**
     * Set User
     * 
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->_setPhysicalPersons();
    }

    /**
     * Get Heirs
     * @return array
     */
    public function getHeirs()
    {
        $result = [];
        if($this->hasChildren()) {
            if($this->isMarried()) {
                $result = $this->_handleMarriedWithChildren();
            } else {
                $result = $this->_handleSingleWithChildren();
            }
        } elseif ($this->isMarried()) {
            $result = $this->_handleMarriedWithoutChildren();
        } else {
            $result = $this->_handleSingleWithoutChildren();
        }
        return $result;
    }

    
    private function _handleMarriedWithChildren()
    {
        
    }

    private function _handleSingleWithChildren()
    {
        $result     = [];
        $cradle     = $this->getCradle();
        $properties = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle  = $this->getPropertiesSum($properties);
        $children   = $this->getChildren();
        $nbChildren = count($children);
        $liquidationsFiscalities = $this->em->getRepository(LiquidationFiscality::class)->findBy(['identifier' => LiquidationFiscality::inherit]);
        $liquidationFiscality = $liquidationsFiscalities[0];
        foreach ($children as $child) {
            $allowance   = $child->getLawPosition()->getAllowances()->getValue();
            $amount      = $sumCradle / $nbChildren;
            $taxablePart = $this->_retrieveTaxablePart($amount, $allowance);
            $tax         = $this->getInheritSum($taxablePart, $child->getLawPosition(), $liquidationFiscality)['amount'];
            $result['heirs'][] = [
                'id'                       => $child->getId(),
                'name'                     => $child->getName(),
                'firstName'                => $child->getFirstName(),
                'amount'                   => $amount,
                'familyPosition'           => $child->getFamilyPosition()->getName(),
                'familyPositionIdentifier' => $child->getFamilyPosition()->getIdentifier(),
                'allowance'                => $allowance,
                'taxablePart'              => $taxablePart,
                'maxInheritRate'           => 'maxInheritRate',
                'tax'                      => $tax,
                'netSum'                   => $amount - $tax,
                'taxes'                    => $this->getInheritSum($taxablePart, $child->getLawPosition(), $liquidationFiscality)['taxes'],
            ];
        }
        $result['transferableQuota'] = 'transferableQuota';
        return $result;
        
    }

    /**
     * 
     * @param int $taxablePart
     * @param LawPosition $lawPosition
     * @return array
     */
    public function getInheritSum(int $taxablePart, LawPosition $lawPosition, LiquidationFiscality $liquidationFiscality) 
    {
        $scales = $this->em->getRepository(FiscalityAmountBearing::class)->findBy([
            'lawPositions'         => $lawPosition, 
            'liquidationFiscality' => $liquidationFiscality,
        ]);
        $taxes     = [];
        $nbScales  = count($scales);
        for ($i=1; $i < $nbScales; $i++) {
            $prevRate = $scales[$i -1]->getRate();
            if ($taxablePart > $scales[$i]->getAmount()) {
                $taxes[$prevRate] = ($scales[$i]->getAmount() - $scales[$i -1]->getAmount()) * $prevRate / 100;
                if ($i === $nbScales - 1) {
                    $taxes[$scales[$i]->getRate()] = ($taxablePart - $scales[$i]->getAmount()) * $scales[$i]->getRate() / 100;
                }
            } else if ($taxablePart > $scales[$i -1]->getAmount()) {

                $taxes[$prevRate] = ($taxablePart - $scales[$i -1]->getAmount()) * $scales[$i -1]->getRate() / 100;
            }
        }

        return [
            'taxes'  => $taxes,
            'amount' => floor(array_sum($taxes)),
        ];
    }

    /**
     * 
     * @param int $amount
     * @param int $allowance
     * @return number
     */
    private function _retrieveTaxablePart($amount, $allowance)
    {
        $result = 0;
        if ($amount > $allowance) {
            $result = $amount - $allowance;
        }
        return $result;
    }

    private function _handleMarriedWithoutChildren()
    {
        $cradle     = $this->getCradle();
        $properties = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle  = $this->getPropertiesSum($properties);
    }

    private function _handleSingleWithoutChildren()
    {
        $cradle     = $this->getCradle();
        $properties = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle  = $this->getPropertiesSum($properties);
    }

    /**
     * get Children
     * 
     * @return array
     */
    public function getChildren()
    {
        $children = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::child) {
                $children[] = $physicalPerson;
            }
        }
        return $children;
    }
    /**
     * 
     * @param array $properties
     * @return number
     */
    public function getPropertiesSum(array $properties)
    {
        $sum = 0;
        foreach ($properties as $property) {
            if ($property->getPropertyTypes()->getLiquidationFiscality()->getIdentifier() === LiquidationFiscality::inherit) {
                $sum += $property->getValue();
            }
        }
        return $sum;
    }
    /**
     * Has Children
     * 
     * @return boolean
     */
    public function hasChildren()
    {
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::child) {
                return true;
            }
        }
        return false;
    }

    /**
     * Is Married
     * 
     * @return boolean
     */
    public function isMarried()
    {
        foreach ($this->physicalPersons as $physicalPerson) {
            if (   $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::commonCommunity
                || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::movableCommunity
                || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::participation
                || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::separatedProperty
                || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::universalCommunity) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get Cradle
     *
     * @return string|PhysicalPerson
     */
    public function getCradle()
    {
        $result = '';
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->isCradle()) {
                $result = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     * Set Physical Persons
     */
    private function _setPhysicalPersons()
    {
        $this->physicalPersons = $this->em->getRepository(PhysicalPerson::class)->findBy(['user' => $this->user]);
    }


}
