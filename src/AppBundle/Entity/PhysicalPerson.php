<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * PhysicalPerson
 *
 * @ORM\Table(name="physical_person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhysicalPersonRepository")
 */
class PhysicalPerson
{


    /**
    * @ORM\ManyToMany(targetEntity="Property", mappedBy="physicalPersons")
    * 
    */
    private $properties;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="physicalPersons")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="FamilyPosition", inversedBy="physicalPersons")
     * @ORM\JoinColumn(name="family_position_id", referencedColumnName="id")
     */
    private $familyPosition;
    
    /**
     * @ORM\ManyToOne(targetEntity="LawPosition", inversedBy="physicalPersons")
     * @ORM\JoinColumn(name="law_position_id", referencedColumnName="id")
     */
    private $lawPosition;
    
    /**
     * @ORM\ManyToMany(targetEntity="PhysicalPerson", inversedBy="physicalPerson")
     * @ORM\JoinColumn(nullable=true, onDelete="cascade")
     */
    private $parents;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="cradle", type="boolean")
     */
    private $cradle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birth_date", type="datetime", nullable=true)
     */
    private $birthDate;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="alive", type="boolean", nullable=true)
     */
    private $alive;
    
    /**
     * @ORM\OneToMany(targetEntity="Priority", mappedBy="physicalPerson")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    private $priorities;
    

    public function __construct()
    {
        $this->properties      = new ArrayCollection(); 
    }

    public function addProperty(Property $property)    
    {
        $this->properties[] = $property;
        return $this;       
    }
    
    public function removeProperty(Property $property)
    {
        $this->properties->removeElement($property);
    }
    
    public function getProperties()
    
    {
        return $this->properties;
    }
    
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return PhysicalPerson
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return PhysicalPerson
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cradle.
     *
     * @param bool $cradle
     *
     * @return PhysicalPerson
     */
    public function setCradle($cradle)
    {
        $this->cradle = $cradle;

        return $this;
    }

    /**
     * Is cradle.
     *
     * @return bool
     */
    public function isCradle()
    {
        return $this->cradle;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime|null $birthDate
     *
     * @return PhysicalPerson
     */
    public function setBirthDate($birthDate = null)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime|null
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User|null $user
     *
     * @return PhysicalPerson
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set familyPosition.
     *
     * @param \AppBundle\Entity\FamilyPosition|null $familyPosition
     *
     * @return PhysicalPerson
     */
    public function setFamilyPosition(\AppBundle\Entity\FamilyPosition $familyPosition = null)
    {
        $this->familyPosition = $familyPosition;

        return $this;
    }

    /**
     * Get familyPosition.
     *
     * @return \AppBundle\Entity\FamilyPosition|null
     */
    public function getFamilyPosition()
    {
        return $this->familyPosition;
    }

    

    /**
     * Add physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson $physicalPerson
     *
     * @return PhysicalPerson
     */
    public function addParent(\AppBundle\Entity\PhysicalPerson $physicalPerson)
    {
        $this->parents[] = $physicalPerson;

        return $this;
    }




    /**
     * Get cradle.
     *
     * @return bool
     */
    public function getCradle()
    {
        return $this->cradle;
    }

    /**
     * Remove parent.
     *
     * @param \AppBundle\Entity\PhysicalPerson $parent
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeParent(\AppBundle\Entity\PhysicalPerson $parent)
    {
        return $this->parents->removeElement($parent);
    }

    /**
     * Get parents.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParents()
    {
        return $this->parents;
    }
    
    public  function getParentIds()
    {
        $parentIds = [];
        
        foreach ($this->parents as $parent) {
            $parentIds[] = $parent->getId();
        }
        
        return $parentIds; 
    }

    /**
     * Get Age
     * @return number
     */
    public function getAge()
    {
        return 45;
    }
    /**
     * Set lawPosition.
     *
     * @param \AppBundle\Entity\lawPosition|null $lawPosition
     *
     * @return PhysicalPerson
     */
    public function setLawPosition(\AppBundle\Entity\lawPosition $lawPosition = null)
    {
        $this->lawPosition = $lawPosition;

        return $this;
    }

    /**
     * Get lawPosition.
     *
     * @return \AppBundle\Entity\lawPosition|null
     */
    public function getLawPosition()
    {
        return $this->lawPosition;
    }

    /**
     * Set alive.
     *
     * @param bool $alive
     *
     * @return PhysicalPerson
     */
    public function setAlive($alive)
    {
        $this->alive = $alive;

        return $this;
    }

    /**
     * Get alive.
     *
     * @return bool
     */
    public function getAlive()
    {
        return $this->alive;
    }

    /**
     * Add priority.
     *
     * @param \AppBundle\Entity\Priority $priority
     *
     * @return PhysicalPerson
     */
    public function addPriority(\AppBundle\Entity\Priority $priority)
    {
        $this->priorities[] = $priority;

        return $this;
    }

    /**
     * Remove priority.
     *
     * @param \AppBundle\Entity\Priority $priority
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePriority(\AppBundle\Entity\Priority $priority)
    {
        return $this->priorities->removeElement($priority);
    }

    /**
     * Get priorities.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPriorities()
    {
        return $this->priorities;
    }

    /**
     * Is cradle child
     * @return boolean
     */
    public function isCradleChild()
    {
        $result = false;
        foreach ($this->getParents() as $parent) {
            if ($this->getLawPosition()->getIdentifier() === LawPosition::child && $parent->isCradle()) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
