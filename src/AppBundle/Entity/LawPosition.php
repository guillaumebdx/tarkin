<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LawPosition
 *
 * @ORM\Table(name="law_position")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LawPositionRepository")
 */
class LawPosition
{
    
    
    const commonCommunity    = 'common-community';
    const separatedProperty  = 'separated-property';
    const participation      = 'participation';
    const universalCommunity = 'universal-community';
    const movableCommunity   = 'movable-community';
    const individedPacs      = 'individed-pacs';
    const sibling            = 'sibling';
    const parent             = 'parent';
    const child              = 'child';
    const uncleAunt          = 'uncle-aunt';
    const greatParent        = 'great-parent';
    const greatChild         = 'great-child';
    
    
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="spouse", type="boolean")
     */
    private $spouse;


    /**
     * Class constructor
     *
     * @param string $name
     */
    public function __construct(string $name = null, string $identifier = null)
    {
        $this->setName($name);
        $this->setIdentifier($identifier);
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
     * @return LawPosition
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
     * @param bool $spouse
     *
     * @return LawPosition
     */
    public function setSpouse($spouse)
    {
        $this->spouse = $spouse;
        
        return $this;
    }
    
    /**
     * Get spouse.
     *
     * @return bool
     */
    public function getSpouse()
    {
        return $this->spouse;
    }

    /**
     * Set identifier.
     *
     * @param string $identifier
     *
     * @return LawPosition
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
