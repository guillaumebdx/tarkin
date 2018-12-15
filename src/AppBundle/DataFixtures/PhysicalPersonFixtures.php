<?php 
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PhysicalPerson;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use AppBundle\Entity\FamilyPosition;

class PhysicalPersonFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName('Jean');
        $physicalPerson->setName('Démo');
        $physicalPerson->setBirthDate(new \DateTime('1981-11-18'));
        $physicalPerson->setCradle(true);
        $user = $manager->getRepository(User::class)->findOneBy(array('nameReference' => 'Démo'));
        $physicalPerson->setUser($user);
        $familyPosition = $manager->getRepository(FamilyPosition::class)->findOneBy(array('identifier' => FamilyPosition::conjoint));
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