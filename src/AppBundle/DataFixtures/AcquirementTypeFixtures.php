<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\AcquirementType;


class AcquirementTypeFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $acquirementType = new AcquirementType();
        $acquirementType->setName('Acquis avant le mariage');
        $acquirementType->setIdentifier(AcquirementType::beforeMarriage);
        $manager->persist($acquirementType);
        
        $acquirementType = new AcquirementType();
        $acquirementType->setName('Acquis pendant le mariage');
        $acquirementType->setIdentifier(AcquirementType::duringMarriage);
        $manager->persist($acquirementType);
        
        $acquirementType = new AcquirementType();
        $acquirementType->setName('Acquis par donation / Succession');
        $acquirementType->setIdentifier(AcquirementType::donateInherit);
        $manager->persist($acquirementType);
        
        $manager->flush();
    }
    
    
}