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


    /**
     * @ORM\ManyToOne(targetEntity="LawPosition", inversedBy="lawPositions")
     * @ORM\JoinColumn(name="law_position_id", referencedColumnName="id")
     */
    private $lawPositions;
    
    /**
     * @ORM\ManyToOne(targetEntity="FiscalityAmountBearing", inversedBy="fiscalityAmountBearings")
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
     * Set lawPositions.
     *
     * @param \AppBundle\Entity\LawPosition|null $lawPositions
     *
     * @return LiquidationFiscality
     */
    public function setLawPositions(\AppBundle\Entity\LawPosition $lawPositions = null)
    {
        $this->lawPositions = $lawPositions;

        return $this;
    }

    /**
     * Get lawPositions.
     *
     * @return \AppBundle\Entity\LawPosition|null
     */
    public function getLawPositions()
    {
        return $this->lawPositions;
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
}
