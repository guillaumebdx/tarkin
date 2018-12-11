<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiscalityAmountBearing
 *
 * @ORM\Table(name="fiscality_amount_bearing")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FiscalityAmountBearingRepository")
 */
class FiscalityAmountBearing
{


    /**
     * @ORM\ManyToOne(targetEntity="FiscalityYearBearing", inversedBy="fiscalityYearBearings")
     * @ORM\JoinColumn(name="fiscality_year_bearing_id", referencedColumnName="id")
     */
    private $fiscalityYearBearings;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;
    
    /**
     * @ORM\ManyToMany(targetEntity="LiquidationFiscality")
     * @ORM\JoinColumn(name="liquidation_fiscality_id", referencedColumnName="id")
     */
    private $liquidationFiscalities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->liquidationFiscalities = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add liquidationFiscality.
     *
     * @param \AppBundle\Entity\LiquidationFiscality $liquidationFiscality
     *
     * @return FiscalityAmountBearing
     */
    public function addLiquidationFiscality(\AppBundle\Entity\LiquidationFiscality $liquidationFiscality)
    {
        $this->liquidationFiscalities[] = $liquidationFiscality;
        return $this;
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
     * Set rate.
     *
     * @param int $rate
     *
     * @return FiscalityAmountBearing
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate.
     *
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set fiscalityYearBearings.
     *
     * @param \AppBundle\Entity\FiscalityYearBearing|null $fiscalityYearBearings
     *
     * @return FiscalityAmountBearing
     */
    public function setFiscalityYearBearings(\AppBundle\Entity\FiscalityYearBearing $fiscalityYearBearings = null)
    {
        $this->fiscalityYearBearings = $fiscalityYearBearings;

        return $this;
    }

    /**
     * Get fiscalityYearBearings.
     *
     * @return \AppBundle\Entity\FiscalityYearBearing|null
     */
    public function getFiscalityYearBearings()
    {
        return $this->fiscalityYearBearings;
    }

    /**
     * Set amount.
     *
     * @param int $amount
     *
     * @return FiscalityAmountBearing
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
