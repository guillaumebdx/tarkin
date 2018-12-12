<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LiquidationFiscality
 *
 * @ORM\Table(name="liquidation_fiscality")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LiquidationFiscalityRepository")
 */
class LiquidationFiscality
{

    const lifeInsurance = 'life-insurance';
    const inherit       = 'inherit';

    
    /**
     * @ORM\ManyToMany(targetEntity="FiscalityAmountBearing")
     * @ORM\JoinColumn(name="fiscality_amount_bearing_id", referencedColumnName="id")
     */
    private $fiscalityAmountBearings;

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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255, unique=false)
     */
    private $identifier;


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
     * @return LiquidationFiscality
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
     * @return LiquidationFiscality
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
     * Set fiscalityAmountBearings.
     *
     * @param \AppBundle\Entity\FiscalityAmountBearing|null $fiscalityAmountBearings
     *
     * @return LiquidationFiscality
     */
    public function setFiscalityAmountBearings(\AppBundle\Entity\FiscalityAmountBearing $fiscalityAmountBearings = null)
    {
        $this->fiscalityAmountBearings = $fiscalityAmountBearings;

        return $this;
    }

    /**
     * Get fiscalityAmountBearings.
     *
     * @return \AppBundle\Entity\FiscalityAmountBearing|null
     */
    public function getFiscalityAmountBearings()
    {
        return $this->fiscalityAmountBearings;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fiscalityAmountBearings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fiscalityAmountBearing.
     *
     * @param \AppBundle\Entity\FiscalityAmountBearing $fiscalityAmountBearing
     *
     * @return LiquidationFiscality
     */
    public function addFiscalityAmountBearing(\AppBundle\Entity\FiscalityAmountBearing $fiscalityAmountBearing)
    {
        $this->fiscalityAmountBearings[] = $fiscalityAmountBearing;

        return $this;
    }

    /**
     * Remove fiscalityAmountBearing.
     *
     * @param \AppBundle\Entity\FiscalityAmountBearing $fiscalityAmountBearing
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFiscalityAmountBearing(\AppBundle\Entity\FiscalityAmountBearing $fiscalityAmountBearing)
    {
        return $this->fiscalityAmountBearings->removeElement($fiscalityAmountBearing);
    }
}
