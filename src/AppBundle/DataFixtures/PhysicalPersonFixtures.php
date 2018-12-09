<?php 
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\PhysicalPerson;

class PhysicalPersonFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setBirthDate('1981-11-18');
        $physicalPerson->setCradle(true);

    }
    
    
}