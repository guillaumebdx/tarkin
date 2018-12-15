<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Entity\LawPosition;


class FamilyPositionFixtures extends Fixture implements ORMFixtureInterface

{

/**
 * For this fixture, we don't set lawPosition for conjoints. It is setted in physicalPerson
 * 
 * {@inheritDoc}
 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
 */
    public function load(ObjectManager $manager)
    {
//         spouses
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Conjoint');
        $familyPosition->setIdentifier(FamilyPosition::conjoint);
        $manager->persist($familyPosition);
        
//         others
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Frère / Soeur');
        $familyPosition->setIdentifier(FamilyPosition::sibling);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Père / Mère');
        $familyPosition->setIdentifier(FamilyPosition::parent);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Enfant');
        $familyPosition->setIdentifier(FamilyPosition::child);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Oncle / Tante');
        $familyPosition->setIdentifier(FamilyPosition::uncleAunt);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Grand-parent');
        $familyPosition->setIdentifier(FamilyPosition::greatParent);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Petit-enfant');
        $familyPosition->setIdentifier(FamilyPosition::greatChild);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Parent jusqu\'au 4ème degré');
        $familyPosition->setIdentifier(FamilyPosition::upToFourthDegree);
        $manager->persist($familyPosition);
        
        $familyPosition = new FamilyPosition();
        $familyPosition->setName('Non-parent ou au delà du 4ème degré');
        $familyPosition->setIdentifier(FamilyPosition::beyondFourthDegree);
        $manager->persist($familyPosition);
       
        $manager->flush();
    }

    
}