<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    
    /**
     * @ORM\OneToMany(targetEntity="PhysicalPerson", mappedBy="user")
     */
    private $physicalPersons;
    
    public function __construct()
    {
        $this->physicalPersons = new ArrayCollection();
    }
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_canonical", type="string", length=255)
     */
    private $emailCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="name_reference", type="string", length=255)
     */
    private $nameReference;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


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
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set emailCanonical.
     *
     * @param string $emailCanonical
     *
     * @return User
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    /**
     * Get emailCanonical.
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * Set nameReference.
     *
     * @param string $nameReference
     *
     * @return User
     */
    public function setNameReference($nameReference)
    {
        $this->nameReference = $nameReference;

        return $this;
    }

    /**
     * Get nameReference.
     *
     * @return string
     */
    public function getNameReference()
    {
        return $this->nameReference;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson $physicalPerson
     *
     * @return User
     */
    public function addPhysicalPerson(\AppBundle\Entity\PhysicalPerson $physicalPerson)
    {
        $this->physicalPersons[] = $physicalPerson;

        return $this;
    }

    /**
     * Remove physicalPerson.
     *
     * @param \AppBundle\Entity\PhysicalPerson $physicalPerson
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePhysicalPerson(\AppBundle\Entity\PhysicalPerson $physicalPerson)
    {
        return $this->physicalPersons->removeElement($physicalPerson);
    }

    /**
     * Get physicalPersons.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhysicalPersons()
    {
        return $this->physicalPersons;
    }
}
