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
        $physicalPerson->setFirstName('Thibault');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Diarra'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
        $physicalPerson->setFamilyPosition($familyPosition);
        $manager->persist($physicalPerson);
        
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
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Jaden');
        $physicalPerson->setName('Diarra');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Diarra'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
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
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Paul');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('2004-02-03'));
        $physicalPerson->setCradle(false);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::child));
        $physicalPerson->setFamilyPosition($familyPosition);
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