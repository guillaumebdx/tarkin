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
     * @ORM\ManyToMany(targetEntity="PhysicalPerson", inversedBy="physicalPerson")
     * @ORM\JoinColumn(nullable=true, onDelete="cascade")
     */
    private $parents;
    
    /**
     * @ORM\OneToMany(targetEntity="PhysicalPerson", mappedBy="parent")
     */
    private $physicalPersons;
    
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
     * Set parent.
     *
     * @param \AppBundle\Entity\PhysicalPerson|null $parent
     *
     * @return PhysicalPerson
     */
    public function setParent(\AppBundle\Entity\PhysicalPerson $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }
    
    /**
     * Get parent.
     *
     * @return \AppBundle\Entity\PhysicalPerson|null
     */
    public function getParents()
    {
        return $this->parents;
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
     * Remove physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson $physicalPerson
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePhysicalPerson(\AppBundle\Entity\PhysicalPerson $physicalPerson)
    {
        return $this->physicalPersons->removeElement($physicalPerson);
    }

    /**
     * Get physicalPersons.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhysicalPersons()
    {
        return $this->physicalPersons;
    }

}
