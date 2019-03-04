<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Priority
 *
 * @ORM\Table(name="priority")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PriorityRepository")
 */
class Priority
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
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="PhysicalPerson", inversedBy="priorities")
     * @ORM\JoinTable(name="physical_person_priority")
     */
    private $physicalPerson;

    /**
     * @ORM\ManyToOne(targetEntity="PriorityType")
     * @ORM\JoinColumn(name="priority_type_id", referencedColumnName="id")
     * 
     */
    private $priorityType;
    


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
     * Set value.
     *
     * @param int $value
     *
     * @return Priority
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson|null $physicalPerson
     *
     * @return Priority
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

    /**
     * Set priorityType.
     *
     * @param \AppBundle\Entity\PriorityType|null $priorityType
     *
     * @return Priority
     */
    public function setPriorityType(\AppBundle\Entity\PriorityType $priorityType = null)
    {
        $this->priorityType = $priorityType;

        return $this;
    }

    /**
     * Get priorityType.
     *
     * @return \AppBundle\Entity\PriorityType|null
     */
    public function getPriorityType()
    {
        return $this->priorityType;
    }
}
