<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Entity\LawPosition;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FamilyPositionFixtures extends Fixture implements DependentFixtureInterface

{

/**
 * For this fixture, we don't set lawPosition for conjoints. It is setted in physicalPerson
 * 
 * {@inheritDoc}
 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
 */
    public function load(ObjectManager $manager)
    {
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Conjoint');
        $familyPosition->setIdentifier(FamilyPosition::conjoint);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Frère / Soeur');
        $familyPosition->setIdentifier(FamilyPosition::sibling);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::sibling));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Père / Mère');
        $familyPosition->setIdentifier(FamilyPosition::parent);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::parent));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Enfant');
        $familyPosition->setIdentifier(FamilyPosition::child);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::child));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Oncle / Tante');
        $familyPosition->setIdentifier(FamilyPosition::uncleAunt);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::uncleAunt));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Grand-parent');
        $familyPosition->setIdentifier(FamilyPosition::greatParent);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::greatParent));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Petit-enfant');
        $familyPosition->setIdentifier(FamilyPosition::greatChild);
        $familyPosition->setLawPositions();
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::greatChild));
        $familyPosition->setLawPositions($lawPosition);
        $manager->persist($familyPosition);
       
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            LawPositionFixtures::class,
        );
    }
    
}