<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Entity\LawPosition;
use AppBundle\Entity\Allowance;


class LawPositionFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $lawPosition = new LawPosition();
        $lawPosition->setName('Communauté légale (sans contrat de mariage');
        $lawPosition->setIdentifier(LawPosition::commonCommunity);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Séparation de biens');
        $lawPosition->setIdentifier(LawPosition::separatedProperty);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Participation aux acquêts');
        $lawPosition->setIdentifier(LawPosition::participation);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Communauté universelle');
        $lawPosition->setIdentifier(LawPosition::universalCommunity);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Meubles et Acquêts');
        $lawPosition->setIdentifier(LawPosition::movableCommunity);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('PACS (indivision)');
        $lawPosition->setIdentifier(LawPosition::individedPacs);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('PACS (séparation de biens)');
        $lawPosition->setIdentifier(LawPosition::separatedPacs);
        $lawPosition->setSpouse(true);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setName('Concubinage');
        $lawPosition->setIdentifier(LawPosition::cohabitPartner);
        $lawPosition->setSpouse(true);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'fourth'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::sibling);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'second'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::sibling));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::parent);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'first'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::parent));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::child);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'first'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::uncleAunt);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'fourth'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::uncleAunt));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::nephew);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'third'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::nephew));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);

        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::greatParent);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'fourth'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::greatParent));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::greatChild);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'first'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::greatChild));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::upToFourthDegree);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'third'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::upToFourthDegree));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);
        
        $lawPosition = new LawPosition();
        $lawPosition->setIdentifier(LawPosition::beyondFourthDegree);
        $lawPosition->setSpouse(false);
        $allowance = $manager->getRepository(Allowance::class)->findOneBy(array('identifier' => 'fourth'));
        $lawPosition->setAllowances($allowance);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::beyondFourthDegree));
        $lawPosition->setFamilyPosition($familyPosition);
        $manager->persist($lawPosition);

        
        $manager->flush();
        
    }
    public function getDependencies()
    {
        return array(
          FamilyPositionFixtures::class,  
          AllowanceFixtures::class,
        );
    }


   
}