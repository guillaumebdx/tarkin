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
}
