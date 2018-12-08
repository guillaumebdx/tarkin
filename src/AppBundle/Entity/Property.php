<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyRepository")
 */
class Property
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
     * @ORM\Column(name="returnRate", type="integer")
     */
    private $returnRate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="acquirementDate", type="datetime", nullable=true)
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
}
