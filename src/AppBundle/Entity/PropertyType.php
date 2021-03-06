<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyType
 *
 * @ORM\Table(name="property_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyTypeRepository")
 */
class PropertyType
{
    
    
    const aSaving            = 'a-saving';
    const bSaving            = 'b-saving';
    const pel                = 'pel';
    const pea                = 'pea';
    const sharesAccount      = 'shares-account';
    const lifeInsurance      = 'lifeInsurance';
    const pee                = 'pee';
    const perco              = 'perco';
    const fcpi               = 'fcpi';
    const scpi               = 'scpi';
    const principalResidence = 'principal-residence';
    const rentalProperty     = 'rental-property';
    
    
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
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255, unique=true)
     */
    private $identifier;

    /**
     * @var bool
     *
     * @ORM\Column(name="financial", type="boolean")
     */
    private $financial;
    
    /**
     * @ORM\ManyToOne(targetEntity="SaleFiscality", inversedBy="saleFiscality")
     * @ORM\JoinColumn(name="sale_fiscality_id", referencedColumnName="id")
     */
    private $saleFiscality;
    
    /**
     * @ORM\ManyToOne(targetEntity="InterestFiscality", inversedBy="interestFiscality")
     * @ORM\JoinColumn(name="interest_fiscality_id", referencedColumnName="id")
     */
    private $interestFiscality;
    
    /**
     * @ORM\ManyToOne(targetEntity="LiquidationFiscality", inversedBy="liquidationFiscality")
     * @ORM\JoinColumn(name="liquidation_fiscality_id", referencedColumnName="id")
     */
    private $liquidationFiscality;

    /**
     * Set cradle.
     *
     * @param bool $financial
     *
     * @return PropertyType
     */
    public function setFinancial($financial)
    {
        $this->financial = $financial;
        
        return $this;
    }
    
    /**
     * Get financial.
     *
     * @return bool
     */
    public function getFinancial()
    {
        return $this->financial;
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
     * @return PropertyType
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
     * Set identifier.
     *
     * @param string $identifier
     *
     * @return PropertyType
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set saleFiscality.
     *
     * @param \AppBundle\Entity\SaleFiscality|null $saleFiscality
     *
     * @return PropertyType
     */
    public function setSaleFiscality(\AppBundle\Entity\SaleFiscality $saleFiscality = null)
    {
        $this->saleFiscality = $saleFiscality;

        return $this;
    }

    /**
     * Get saleFiscality.
     *
     * @return \AppBundle\Entity\SaleFiscality|null
     */
    public function getSaleFiscality()
    {
        return $this->saleFiscality;
    }

    /**
     * Set interestFiscality.
     *
     * @param \AppBundle\Entity\InterestFiscality|null $interestFiscality
     *
     * @return PropertyType
     */
    public function setInterestFiscality(\AppBundle\Entity\InterestFiscality $interestFiscality = null)
    {
        $this->interestFiscality = $interestFiscality;

        return $this;
    }

    /**
     * Get interestFiscality.
     *
     * @return \AppBundle\Entity\InterestFiscality|null
     */
    public function getInterestFiscality()
    {
        return $this->interestFiscality;
    }

    /**
     * Set liquidationFiscality.
     *
     * @param \AppBundle\Entity\LiquidationFiscality|null $liquidationFiscality
     *
     * @return PropertyType
     */
    public function setLiquidationFiscality(\AppBundle\Entity\LiquidationFiscality $liquidationFiscality = null)
    {
        $this->liquidationFiscality = $liquidationFiscality;

        return $this;
    }

    /**
     * Get liquidationFiscality.
     *
     * @return \AppBundle\Entity\LiquidationFiscality|null
     */
    public function getLiquidationFiscality()
    {
        return $this->liquidationFiscality;
    }
}
