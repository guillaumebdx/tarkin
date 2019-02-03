<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyRepository")
 */
class Property
{

    /**
     * @ORM\ManyToMany(targetEntity="PhysicalPerson", inversedBy="properties")
     * @ORM\JoinTable(name="physical_person_property")
     * 
     */
    
    private $physicalPersons;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyType", inversedBy="propertyTypes")
     * @ORM\JoinColumn(name="property_type_id", referencedColumnName="id")
     */
    private $propertyTypes;

    /**
     * @ORM\ManyToOne(targetEntity="AcquirementType", inversedBy="acquirementTypes")
     * @ORM\JoinColumn(name="acquirement_type_id", referencedColumnName="id", nullable=true)
     */
    private $acquirementTypes;

    
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="value", type="integer", nullable=true)
     */
    private $value;

    /**
     * @var int
     *
     * @ORM\Column(name="return_rate", type="integer")
     */
    private $returnRate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="acquirement_date", type="datetime", nullable=true)
     */
    private $acquirementDate;
    
    /**
     * @ORM\OneToOne(targetEntity="Property", inversedBy="shareWith")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    private $shareWith;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="feeling", type="integer", nullable=true)
     * 
     */
    private $feeling;

    public function __construct() 
    {
        $this->physicalPersons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function addPhysicalPerson(PhysicalPerson $physicalPerson)
    {
        $this->physicalPersons[] = $physicalPerson;
        return $this;
    }
    
    public function removePhysicalPerson(PhysicalPerson $physicalPerson)
    {
        $this->physicalPersons->removeElement($physicalPerson);
    }
    
    public function getPhysicalPersons()
    
    {
        return $this->physicalPersons;
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
     * Set name.
     *
     * @param string $name
     *
     * @return Property
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
     * Set value.
     *
     * @param int|null $value
     *
     * @return Property
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return int|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set returnRate.
     *
     * @param int $returnRate
     *
     * @return Property
     */
    public function setReturnRate($returnRate)
    {
        $this->returnRate = $returnRate;

        return $this;
    }

    /**
     * Get returnRate.
     *
     * @return int
     */
    public function getReturnRate()
    {
        return $this->returnRate;
    }

    /**
     * Set acquirementDate.
     *
     * @param \DateTime|null $acquirementDate
     *
     * @return Property
     */
    public function setAcquirementDate($acquirementDate = null)
    {
        $this->acquirementDate = $acquirementDate;

        return $this;
    }

    /**
     * Get acquirementDate.
     *
     * @return \DateTime|null
     */
    public function getAcquirementDate()
    {
        return $this->acquirementDate;
    }

    /**
     * Set propertyTypes.
     *
     * @param \AppBundle\Entity\PropertyType|null $propertyTypes
     *
     * @return Property
     */
    public function setPropertyTypes(\AppBundle\Entity\PropertyType $propertyTypes = null)
    {
        $this->propertyTypes = $propertyTypes;

        return $this;
    }

    /**
     * Get propertyTypes.
     *
     * @return \AppBundle\Entity\PropertyType|null
     */
    public function getPropertyTypes()
    {
        return $this->propertyTypes;
    }

    /**
     * Set acquirementTypes.
     *
     * @param \AppBundle\Entity\AcquirementType|null $acquirementTypes
     *
     * @return Property
     */
    public function setAcquirementTypes(\AppBundle\Entity\AcquirementType $acquirementTypes = null)
    {
        $this->acquirementTypes = $acquirementTypes;

        return $this;
    }

    /**
     * Get acquirementTypes.
     *
     * @return \AppBundle\Entity\AcquirementType|null
     */
    public function getAcquirementTypes()
    {
        return $this->acquirementTypes;
    }



    /**
     * Set shareWith.
     *
     * @param \AppBundle\Entity\Property|null $shareWith
     *
     * @return Property
     */
    public function setShareWith(\AppBundle\Entity\Property $shareWith = null)
    {
        $this->shareWith = $shareWith;

        return $this;
    }

    /**
     * Get shareWith.
     *
     * @return \AppBundle\Entity\Property|null
     */
    public function getShareWith()
    {
        return $this->shareWith;
    }

    /**
     * Is Shared
     * 
     * @return boolean
     */
    public function isShared()
    {
        $result = true;
        if(null === $this->getShareWith()) {
            $result = false;
        }
        return $result;
    }

    /**
     * Set feeling.
     *
     * @param int|null $feeling
     *
     * @return Property
     */
    public function setFeeling($feeling = null)
    {
        $this->feeling = $feeling;

        return $this;
    }

    /**
     * Get feeling.
     *
     * @return int|null
     */
    public function getFeeling()
    {
        return $this->feeling;
    }
}
