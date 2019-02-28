<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beneficiary
 *
 * @ORM\Table(name="beneficiary")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BeneficiaryRepository")
 */
class Beneficiary
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
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="PhysicalPerson", inversedBy="physicalPerson")
     * @ORM\JoinColumn(name="physical_person_id", referencedColumnName="id")
     */
    private $physicalPerson;

    /**
     * @ORM\ManyToOne(targetEntity="Property", inversedBy="beneficiaries")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    private $property;
    

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
     * Set amount.
     *
     * @param int $amount
     *
     * @return Beneficiary
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

    /**
     * Set property.
     *
     * @param \AppBundle\Entity\Property|null $property
     *
     * @return Beneficiary
     */
    public function setProperty(\AppBundle\Entity\Property $property = null)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property.
     *
     * @return \AppBundle\Entity\Property|null
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson|null $physicalPerson
     *
     * @return Beneficiary
     */
    public function setPhysicalPerson(\AppBundle\Entity\PhysicalPerson $physicalPerson = null)
    {
        $this->physicalPerson = $physicalPerson;

        return $this;
    }

    /**
     * Get physicalPerson.
     *
     * @return \AppBundle\Entity\PhysicalPerson|null
     */
    public function getPhysicalPerson()
    {
        return $this->physicalPerson;
    }
}
