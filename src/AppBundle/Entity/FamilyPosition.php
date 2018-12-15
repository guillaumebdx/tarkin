<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FamilyPosition
 *
 * @ORM\Table(name="family_position")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FamilyPositionRepository")
 */
class FamilyPosition
{


    const conjoint    = 'conjoint';
    const sibling     = 'sibling';
    const parent      = 'parent';
    const child       = 'child';
    const uncleAunt   = 'uncle-aunt';
    const greatParent = 'great-parent';
    const greatChild  = 'great-child';
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255)
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
     * @return FamilyPosition
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
     * @return FamilyPosition
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
     * @return FamilyPosition
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
}
