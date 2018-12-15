<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Property;
use AppBundle\Entity\AcquirementType;
use AppBundle\Entity\PropertyType;
use AppBundle\Entity\PhysicalPerson;


class PropertyFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(15000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::duringMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findAll();
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        
        $manager->persist($property);

        $property = new Property();
        $property->setName('Livret LBP');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(12000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findAll();
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Bouliac');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findAll();
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->addPhysicalPerson($physicalPersons[1]);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif rue de la paix Paris');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::duringMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findAll();
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->addPhysicalPerson($physicalPersons[1]);
        $manager->persist($property);

        $manager->flush();
        
    }
    public function getDependencies()
    {
        return array(
            AcquirementTypeFixtures::class, 
            PropertyTypeFixtures::class,
            PhysicalPersonFixtures::class,
        );
    }


   
}