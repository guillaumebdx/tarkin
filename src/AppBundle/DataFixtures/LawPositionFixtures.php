<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\LawPosition;


class LawPositionFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $lawPosition = new LawPosition();
        $lawPosition->setName('Communauté légale (sans contrat de mariage');
        $lawPosition->setIdentifier(LawPosition::commonCommunity);
        $lawPosition->setSpouse(true);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Séparation de biens');
        $lawPosition->setIdentifier(LawPosition::separatedProperty);
        $lawPosition->setSpouse(true);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Participation aux acquêts');
        $lawPosition->setIdentifier(LawPosition::participation);
        $lawPosition->setSpouse(true);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Communauté universelle');
        $lawPosition->setIdentifier(LawPosition::universalCommunity);
        $lawPosition->setSpouse(true);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Meubles et Acquêts');
        $lawPosition->setIdentifier(LawPosition::movableCommunity);
        $lawPosition->setSpouse(true);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::individedPacs);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::sibling);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::parent);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::child);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::uncleAunt);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);

        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::greatParent);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::greatChild);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::upToFourthDegree);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::beyondFourthDegree);
        $lawPosition->setSpouse(false);
        $manager->persist($lawPosition);

        
        $manager->flush();
        
    }

   
}