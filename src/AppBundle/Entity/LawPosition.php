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
    const separatedPacs      = 'separated-pacs';
    const cohabitPartner     = 'cohabit-partner';
    const sibling            = 'sibling';
    const parent             = 'parent';
    const child              = 'child';
    const uncleAunt          = 'uncle-aunt';
    const nephew             = 'nephew';
    const greatParent        = 'great-parent';
    const greatChild         = 'great-child';
    const upToFourthDegree   = 'up-to-fourth-degree';
    const beyondFourthDegree = 'betond-fourth-degree';
    
    
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
     * @ORM\Column(name="identifier", type="string", length=255)
     */
    private $identifier;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="spouse", type="boolean")
     */
    private $spouse;

    /**
     *
     * @ORM\ManyToOne(targetEntity="FamilyPosition")
     */
    private $familyPositions;

    /**
     * @ORM\ManyToOne(targetEntity="Allowance", inversedBy="lawPosition")
     * @ORM\JoinColumn(name="allowance_id", referencedColumnName="id")
     */
    private $allowances;

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
    public function isSpouse()
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

    public function setFamilyPosition($familyPosition)
    {
        $this->familyPositions = $familyPosition;
        
        return $this;
    }
    

    public function getFamilyPosition()
    {
        return $this->familyPositions;
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
     * Set familyPositions.
     *
     * @param \AppBundle\Entity\FamilyPosition|null $familyPositions
     *
     * @return LawPosition
     */
    public function setFamilyPositions(\AppBundle\Entity\FamilyPosition $familyPositions = null)
    {
        $this->familyPositions = $familyPositions;

        return $this;
    }

    /**
     * Get familyPositions.
     *
     * @return \AppBundle\Entity\FamilyPosition|null
     */
    public function getFamilyPositions()
    {
        return $this->familyPositions;
    }



    /**
     * Set allowance.
     *
     * @param \AppBundle\Entity\Allowance|null $allowance
     *
     * @return LawPosition
     */
    public function setAllowance(\AppBundle\Entity\Allowance $allowance = null)
    {
        $this->allowance = $allowance;

        return $this;
    }

    /**
     * Get allowance.
     *
     * @return \AppBundle\Entity\Allowance|null
     */
    public function getAllowance()
    {
        return $this->allowance;
    }

    /**
     * Set allowances.
     *
     * @param \AppBundle\Entity\Allowance|null $allowances
     *
     * @return LawPosition
     */
    public function setAllowances(\AppBundle\Entity\Allowance $allowances = null)
    {
        $this->allowances = $allowances;

        return $this;
    }

    /**
     * Get allowances.
     *
     * @return \AppBundle\Entity\Allowance|null
     */
    public function getAllowances()
    {
        return $this->allowances;
    }
}
