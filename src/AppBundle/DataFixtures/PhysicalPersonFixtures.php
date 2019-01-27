<?php 
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PhysicalPerson;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Entity\Property;

class PhysicalPersonFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Stan');
        $physicalPerson->setName('CELIB');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST CELIB'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Isabelle');
        $physicalPerson->setName('PACS');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST PACS'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Delphine');
        $physicalPerson->setName('sep');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST SEPARATION DE BIENS'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Julie');
        $physicalPerson->setName('conc');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST CONCUBIN'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Valérie');
        $physicalPerson->setName('legale');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST REGIME LEGAL'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);

        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('John');
        $physicalPerson->setName('com');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'TEST COMM UNIV'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Xavier');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Coupé'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Thibault');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Diarra'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        $parent3 = $physicalPerson;
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Claudia');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Diarra'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        $parent4 = $physicalPerson;
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Jaden');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Diarra'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
        $physicalPerson->addParent($parent3);
        $physicalPerson->addParent($parent4);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Guillaume');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        $parent1 = $physicalPerson;
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Johanne');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('1981-09-08'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        $parent2 = $physicalPerson;
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Paul');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('2004-02-03'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
        $physicalPerson->addParent($parent1);
        $physicalPerson->addParent($parent2);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Marie');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('2007-05-13'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
        $physicalPerson->addParent($parent1);
        $physicalPerson->addParent($parent2);
        $manager->persist($physicalPerson);
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Jean');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('2002-01-11'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
        $physicalPerson->addParent($parent1);
        $physicalPerson->addParent($parent2);
        $manager->persist($physicalPerson);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            FamilyPositionFixtures::class,
       
        );
    }

    
    
}