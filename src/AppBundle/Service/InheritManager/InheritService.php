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
use SensioLabs\Security\Result;
use AppBundle\Entity\FamilyPosition;

class InheritService

{


    const USUFRUCT       = 'Usufruit';
    const NAKED_PROPERTY = 'Nue-propriété';
    const FULL_OWNERSHIP = 'Pleine propriété';

    protected $em;
    private   $container;
    private   $user;
    private   $physicalPersons;
    private   $usufructValues;

    /**
     * Class constructor
     * 
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em             = $em;
        $this->container      = $container;
        $this->usufructValues = [
            21   => 0.9,
            31   => 0.8,
            41   => 0.7,
            51   => 0.6,
            61   => 0.5,
            71   => 0.4,
            81   => 0.3,
            91   => 0.2,
        ];
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
            $result = $this->_handleMarriedWithoutChild();
        } else {
            $result = $this->_handleSingleWithoutChild();
        }
        return $result;
    }

    
    /**
     * 
     * @param PhysicalPerson $heir
     * @param int $amount
     * @param int $allowance
     * @param int $taxablePart
     * @param int $tax
     * @param LiquidationFiscality $liquidationFiscality
     * @param string $propertyType
     * @return array
     */
    public function buildInheritArray(PhysicalPerson $heir, int $amount, int $allowance, int $taxablePart, int $tax, LiquidationFiscality $liquidationFiscality, string $propertyType)
    {
        return [
            'id'                       => $heir->getId(),
            'name'                     => $heir->getName(),
            'firstName'                => $heir->getFirstName(),
            'amount'                   => $amount,
            'familyPosition'           => $heir->getFamilyPosition()->getName(),
            'familyPositionIdentifier' => $heir->getFamilyPosition()->getIdentifier(),
            'allowance'                => $allowance,
            'taxablePart'              => $taxablePart,
            'maxInheritRate'           => 'maxInheritRate',
            'tax'                      => $tax,
            'netSum'                   => $amount - $tax,
            'taxes'                    => $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['taxes'],
            'propertyType'             => $propertyType,
        ];
    }
    /**
     * 
     * @param int $taxablePart
     * @param LawPosition $lawPosition
     * @return array
     * 
     * 
     */
    public function getInheritSum(int $taxablePart, LawPosition $lawPosition, LiquidationFiscality $liquidationFiscality) 
    {
        $scales = $this->em->getRepository(FiscalityAmountBearing::class)->findBy([
            'lawPositions'         => $lawPosition, 
            'liquidationFiscality' => $liquidationFiscality,
        ]);
        $taxes     = [];
        $nbScales  = count($scales);
        if ($nbScales === 1) {
            $taxes[$scales[0]->getRate()] = $taxablePart * $scales[0]->getRate() / 100;
        } else {
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

    /**
     * 
     * @return array
     * 
     */
    private function _handleMarriedWithoutChild()
    {
        //TODO Ajouter la règle des parents
        // https://droit-finances.commentcamarche.com/contents/1000-succession-heritage-et-heritiers#le-defunt-etait-marie
        $cradle     = $this->getCradle();
        $properties = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $amount     = $this->getPropertiesSum($properties);
        $allowance  = 0;
        $tax        = 0;
        $liquidationsFiscalities = $this->em->getRepository(LiquidationFiscality::class)->findBy(['identifier' => LiquidationFiscality::inherit]);
        $liquidationFiscality = $liquidationsFiscalities[0];
        $taxablePart = $amount;
        foreach ($this->physicalPersons as $physicalPerson) {
            if($physicalPerson->isCradle() === false) {
                $heir = $physicalPerson;
            }
        }
        $result = [];
        $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
        return $result;
    }

    /**
     * 
     * @return array
     */
    private function _handleMarriedWithChildren()
    {
        $result                  = [];
        $cradle                  = $this->getCradle();
        $properties              = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle               = $this->getPropertiesSum($properties);
        $children                = $this->getChildren();
        $nbChildren              = count($children);
        $liquidationsFiscalities = $this->em->getRepository(LiquidationFiscality::class)->findBy(['identifier' => LiquidationFiscality::inherit]);
        $liquidationFiscality    = $liquidationsFiscalities[0];
        foreach ($this->physicalPersons as $physicalPerson) {
            if($physicalPerson->isCradle() === false && $physicalPerson->getFamilyPosition()->getIdentifier() === FamilyPosition::conjoint ) {
                $spouse = $physicalPerson;
            }
        }
        $usufructRate      = $this->getUsufructValue($sumCradle, $spouse->getAge());
        $nakedProperty     = 1 - $usufructRate;
        $result            = [];
        $result['heirs'][] = $this->buildInheritArray($spouse, $sumCradle * $usufructRate, 0, $sumCradle * $usufructRate, 0, $liquidationFiscality, self::USUFRUCT);
        foreach ($children as $heir) {
            $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
            $amount            = ($sumCradle * $nakedProperty) / $nbChildren;
            $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
            $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
            $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::NAKED_PROPERTY);
        }
        
        return $result;
    }

    /**
     *
     * @return array
     */
    private function _handleSingleWithChildren()
    {
        $result                  = [];
        $cradle                  = $this->getCradle();
        $properties              = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle               = $this->getPropertiesSum($properties);
        $children                = $this->getChildren();
        $nbChildren              = count($children);
        $liquidationsFiscalities = $this->em->getRepository(LiquidationFiscality::class)->findBy(['identifier' => LiquidationFiscality::inherit]);
        $liquidationFiscality    = $liquidationsFiscalities[0];
        foreach ($children as $heir) {
            $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
            $amount            = $sumCradle / $nbChildren;
            $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
            $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
            $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
        }
        $result['transferableQuota'] = 'transferableQuota';
        return $result;
        
    }

    /**
     * 
     * @return array
     */
    private function _handleSingleWithoutChild()
    {
        $cradle                  = $this->getCradle();
        $properties              = $this->em->getRepository(Property::class)->findByPhysicalPerson($cradle);
        $sumCradle               = $this->getPropertiesSum($properties);
        $parents                 = $this->retrieveParents() ;
        $siblings                = $this->retrieveSiblings();
        $unclesAunts             = $this->retrieveUnclesAunts();
        $nephews                 = $this->retrieveNephews();
        $beyondFourthDegree      = $this->retrieveBeyondFourthDegree();
        $upToFourthDegree        = $this->retrieveUpToFourthDegree();
        $deathSiblings           = $this->retrieveDeathSiblings();
        $greatParents            = $this->retrieveGreatParents();
        $liquidationsFiscalities = $this->em->getRepository(LiquidationFiscality::class)->findBy(['identifier' => LiquidationFiscality::inherit]);
        $liquidationFiscality    = $liquidationsFiscalities[0];
        $result                  = [];
        if (count($parents) === 2) {
            if (count($siblings) > 0) {
                //Le père et la mère reçoivent chacun un quart des biens, l'autre moitié étant partagée entre ses frères et soeurs. 
                //father and mother receive a quarter each. The other half is shared between siblings
                foreach ($parents as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle * 0.25;
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
                foreach ($siblings as $heir) {
                    if ($heir->getAlive() !== false) {
                        $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                        $amount            = ($sumCradle * 0.5) /count($siblings);
                        $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                        $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                        $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                    } else {
                        //TODO REFACTORING por gagner en lisibilité : créer dans l entité méthode getChildren 
                        $i = 0;
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $i++;
                                }
                            }
                        }
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $allowance         = $nephew->getLawPosition()->getAllowances()->getValue();
                                    $amount            = ($sumCradle * 0.5) /count($siblings / $i);
                                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                                    $tax               = $this->getInheritSum($taxablePart, $nephew->getLawPosition(), $liquidationFiscality)['amount'];
                                    $result['heirs'][] = $this->buildInheritArray($nephew, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                                }
                            }
                        }
                    }
                }
            } else {
                //Le père et la mère reçoivent chacun la moitié des biens.
                foreach ($parents as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle * 0.5;
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            }
        } elseif (count($parents) === 1){
            if (count($siblings) > 0) {
                //Le père ou la mère reçoit un quart des biens, le solde étant partagé entre ses frères et soeurs. 
                foreach ($parents as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle * 0.25;
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
                foreach ($siblings as $heir) {
                    if ($heir->getAlive() !== false) {
                        $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                        $amount            = ($sumCradle * 0.75) /count($siblings);
                        $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                        $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                        $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                    } else {
                        //TODO REFACTORING por gagner en lisibilité : créer dans l entité méthode getChildren
                        $i = 0;
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $i++;
                                }
                            }
                        }
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $allowance         = $nephew->getLawPosition()->getAllowances()->getValue();
                                    $amount            = ($sumCradle * 0.75) /count($siblings / $i);
                                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                                    $tax               = $this->getInheritSum($taxablePart, $nephew->getLawPosition(), $liquidationFiscality)['amount'];
                                    $result['heirs'][] = $this->buildInheritArray($nephew, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                                }
                            }
                        }
                    }
                }
                
            } else {
                //Le père ou la mère reçoit la totalité des biens, 
                foreach ($parents as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle / 2;
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            }
        } else {
            if (count($siblings) > 0) {
                //Le patrimoine est partagé entre ses frères et soeurs. 
                foreach ($siblings as $heir) {
                    if ($heir->getAlive() !== false) {
                        $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                        $amount            = $sumCradle /count($siblings);
                        $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                        $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                        $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                    } else {
                        //TODO REFACTORING por gagner en lisibilité : créer dans l entité méthode getChildren
                        $i = 0;
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $i++;
                                }
                            }
                        }
                        foreach ($nephews as $nephew) {
                            foreach ($nephew->getParents() as $nephewParent) {
                                if ($nephewParent === $heir) {
                                    $allowance         = $nephew->getLawPosition()->getAllowances()->getValue();
                                    $amount            = $sumCradle /count($siblings) / $i;
                                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                                    $tax               = $this->getInheritSum($taxablePart, $nephew->getLawPosition(), $liquidationFiscality)['amount'];
                                    $result['heirs'][] = $this->buildInheritArray($nephew, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                                }
                            }
                        }
                    }
                }
            } elseif (count($greatParents) > 0) {
                foreach ($greatParents as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle / count($greatParents);
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            } elseif (count($unclesAunts) > 0) {
                foreach ($unclesAunts as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle / count($unclesAunts);
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            } elseif (count($beyondFourthDegree) > 0) {
                foreach ($beyondFourthDegree as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle / count($beyondFourthDegree);
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            } elseif (count($upToFourthDegree) > 0) {
                foreach ($upToFourthDegree as $heir) {
                    $allowance         = $heir->getLawPosition()->getAllowances()->getValue();
                    $amount            = $sumCradle / count($upToFourthDegree);
                    $taxablePart       = $this->_retrieveTaxablePart($amount, $allowance);
                    $tax               = $this->getInheritSum($taxablePart, $heir->getLawPosition(), $liquidationFiscality)['amount'];
                    $result['heirs'][] = $this->buildInheritArray($heir, $amount, $allowance, $taxablePart, $tax, $liquidationFiscality, self::FULL_OWNERSHIP);
                }
            }
        }
        return $result;
    }

    public function retrieveGreatParents()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::greatParent) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }
    /**
     * 
     * @return array
     */
    public function retrieveDeathSiblings()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::sibling && $physicalPerson->getAlive() === false) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }
    /**
     *
     * @return array
     */
    public function retrieveParents()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::parent) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     *
     * @return array
     */
    public function retrieveSiblings()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::sibling) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     *
     * @return array
     */
    public function retrieveNephews()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::nephew) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     *
     * @return array
     */
    public function retrieveUnclesAunts()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::uncleAunt) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function retrieveBeyondFourthDegree()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::beyondFourthDegree) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     *
     * @return array
     */
    public function retrieveUpToFourthDegree()
    {
        $result = [];
        foreach ($this->physicalPersons as $physicalPerson) {
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::upToFourthDegree) {
                $result[] = $physicalPerson;
            }
        }
        return $result;
    }

    /**
     * Get Usufruct Value
     * 
     * @param int $amount
     * @param int $age
     * @return number
     */
    public function getUsufructValue(int $amount,int $age)
    {
        $result = 0.1;
        foreach ($this->usufructValues as $usufructAge => $usufructRate) {
            if($age < $usufructAge) {
                $result = $usufructRate;
                break;
            }
        }
        return $result;

    }

    /**
     * get Children
     * 
     * @return array
     */
    public function getChildren()
    {
        //TODO reperer plutot par getParents
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
