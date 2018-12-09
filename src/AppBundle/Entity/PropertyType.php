<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyType
 *
 * @ORM\Table(name="property_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyTypeRepository")
 */
class PropertyType
{
    
    
    const aSaving            = 'a-saving';
    const bSaving            = 'b-saving';
    const pel                = 'pel';
    const pea                = 'pea';
    const sharesAccount      = 'shares-account';
    const lifeInsurance      = 'lifeInsurance';
    const pee                = 'pee';
    const perco              = 'perco';
    const fcpi               = 'fcpi';
    const scpi               = 'scpi';
    const principalResidence = 'principal-residence';
    const rentalProperty     = 'rental-property';
    
    
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
     * @var bool
     *
     * @ORM\Column(name="financial", type="boolean")
     */
    private $financial;

    /**
     * Set cradle.
     *
     * @param bool $financial
     *
     * @return PropertyType
     */
    public function setFinancial($financial)
    {
        $this->financial = $financial;
        
        return $this;
    }
    
    /**
     * Get financial.
     *
     * @return bool
     */
    public function getFinancial()
    {
        return $this->financial;
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
     * Set name.
     *
     * @param string $name
     *
     * @return PropertyType
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
     * @return PropertyType
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
}
