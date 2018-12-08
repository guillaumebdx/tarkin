<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiscalityYearBearing
 *
 * @ORM\Table(name="fiscality_year_bearing")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FiscalityYearBearingRepository")
 */
class FiscalityYearBearing
{
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
     * @ORM\Column(name="year_bearing", type="integer")
     */
    private $yearBearing;


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
     * Set yearBearing.
     *
     * @param int $yearBearing
     *
     * @return FiscalityYearBearing
     */
    public function setYearBearing($yearBearing)
    {
        $this->yearBearing = $yearBearing;

        return $this;
    }

    /**
     * Get yearBearing.
     *
     * @return int
     */
    public function getYearBearing()
    {
        return $this->yearBearing;
    }
}
