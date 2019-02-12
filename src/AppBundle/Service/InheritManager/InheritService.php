<?php 


namespace AppBundle\Service\InheritManager;

use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\LawPosition;

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
     * 
     */
    public function getHeirs()
    {
        if($this->hasChildren()) {
            if($this->isMarried()) {
                $this->_handleMarriedWitchChildren();
            } else {
                $this->_handleSingleWitchChildren();
            }
        }
    }

    
    private function _handleMarriedWitchChildren()
    {

    }

    private function _handleSingleWitchChildren()
    {

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
     * Set Physical Persons
     */
    private function _setPhysicalPersons()
    {
        $this->physicalPersons = $this->em->getRepository(PhysicalPerson::class)->findBy(['user' => $this->user]);
    }


}
