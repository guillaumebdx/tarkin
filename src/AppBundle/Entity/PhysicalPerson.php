<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhysicalPerson
 *
 * @ORM\Table(name="physical_person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhysicalPersonRepository")
 */
class PhysicalPerson
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="cradle", type="boolean")
     */
    private $cradle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birth_date", type="datetime", nullable=true)
     */
    private $birthDate;


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
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return PhysicalPerson
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return PhysicalPerson
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
     * Set cradle.
     *
     * @param bool $cradle
     *
     * @return PhysicalPerson
     */
    public function setCradle($cradle)
    {
        $this->cradle = $cradle;

        return $this;
    }

    /**
     * Get cradle.
     *
     * @return bool
     */
    public function getCradle()
    {
        return $this->cradle;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime|null $birthDate
     *
     * @return PhysicalPerson
     */
    public function setBirthDate($birthDate = null)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime|null
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
}
