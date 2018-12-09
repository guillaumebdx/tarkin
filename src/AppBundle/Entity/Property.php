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
     * @ORM\ManyToOne(targetEntity="PropertyType", inversedBy="propertyTypes")
     * @ORM\JoinColumn(name="property_type_id", referencedColumnName="id")
     */
    private $propertyTypes;

    /**
     * @ORM\ManyToOne(targetEntity="AcquirementType", inversedBy="acquirementTypes")
     * @ORM\JoinColumn(name="acquirement_type_id", referencedColumnName="id")
     */
    private $acquirementTypes;

    /**
     * @ORM\ManyToOne(targetEntity="SaleFiscality", inversedBy="saleFiscalities")
     * @ORM\JoinColumn(name="sale_fiscality_id", referencedColumnName="id")
     */
    private $saleFiscalities;

    /**
     * @ORM\ManyToOne(targetEntity="InterestFiscality", inversedBy="interestFiscalities")
     * @ORM\JoinColumn(name="interest_fiscality_id", referencedColumnName="id")
     */
    private $interestFiscalities;

    /**
     * @ORM\ManyToOne(targetEntity="LiquidationFiscality", inversedBy="liquidationFiscalities")
     * @ORM\JoinColumn(name="liquidation_fiscality_id", referencedColumnName="id")
     */
    private $liquidationFiscalities;
    
    
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
     * Set saleFiscalities.
     *
     * @param \AppBundle\Entity\SaleFiscality|null $saleFiscalities
     *
     * @return Property
     */
    public function setSaleFiscalities(\AppBundle\Entity\SaleFiscality $saleFiscalities = null)
    {
        $this->saleFiscalities = $saleFiscalities;

        return $this;
    }

    /**
     * Get saleFiscalities.
     *
     * @return \AppBundle\Entity\SaleFiscality|null
     */
    public function getSaleFiscalities()
    {
        return $this->saleFiscalities;
    }

    /**
     * Set interestFiscalities.
     *
     * @param \AppBundle\Entity\InterestFiscality|null $interestFiscalities
     *
     * @return Property
     */
    public function setInterestFiscalities(\AppBundle\Entity\InterestFiscality $interestFiscalities = null)
    {
        $this->interestFiscalities = $interestFiscalities;

        return $this;
    }

    /**
     * Get interestFiscalities.
     *
     * @return \AppBundle\Entity\InterestFiscality|null
     */
    public function getInterestFiscalities()
    {
        return $this->interestFiscalities;
    }

    /**
     * Set liquidationFiscalities.
     *
     * @param \AppBundle\Entity\LiquidationFiscality|null $liquidationFiscalities
     *
     * @return Property
     */
    public function setLiquidationFiscalities(\AppBundle\Entity\LiquidationFiscality $liquidationFiscalities = null)
    {
        $this->liquidationFiscalities = $liquidationFiscalities;

        return $this;
    }

    /**
     * Get liquidationFiscalities.
     *
     * @return \AppBundle\Entity\LiquidationFiscality|null
     */
    public function getLiquidationFiscalities()
    {
        return $this->liquidationFiscalities;
    }
}
