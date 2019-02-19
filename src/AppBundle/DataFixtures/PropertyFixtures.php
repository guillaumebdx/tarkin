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
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Stan');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);

        $property = new Property();
        $property->setName('Livret LBP');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Stan');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Bouliac');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Isabelle');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif rue de la paix Paris');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Philippe');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement Pessac');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Philippe');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Cap Ferret');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Philippe');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CA');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Delphine');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Jean');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Paris');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Jean');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Jean');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement 2');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Jean');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Royan');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Julie');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Julien');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret LBP');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Valérie');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Bouliac');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Henri');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif rue de la paix Paris');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('John');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement Pessac');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Laure');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Cap Ferret');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Laure');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CA');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('henri');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('John');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Paris');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Laure');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Henri');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement 2');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('John');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Royan');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Laure');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire La Mongie');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Xavier');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO 3');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Xavier');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret LBP');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Severine');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Bouliac');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Severine');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif rue de la paix Paris');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Severine');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement Pessac');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Xavier');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Cap Ferret');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Guillaume');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CA');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Guillaume');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Guillaume');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Paris');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Johanne');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Johanne');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement 2');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Johanne');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Royan');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Guillaume');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement 2');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Thibault');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Royan');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Thibault');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire La Mongie');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Thibault');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO 3');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret LBP');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence principale Bouliac');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2016-11-08'));
        $property->setValue(650000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::principalResidence]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(8);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement locatif rue de la paix Paris');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Appartement Pessac');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(350000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(9);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Résidence secondaire Cap Ferret');
        $property->setReturnRate(7);
        $property->setAcquirementDate(new \DateTime('2017-07-01'));
        $property->setValue(250000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::donateInherit]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::rentalProperty]);
        $property->setPropertyTypes($propertyType);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Thibault');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setFeeling(7);
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CA');
        $property->setReturnRate(1);
        $property->setAcquirementDate(new \DateTime('2018-12-02'));
        $property->setValue(150000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage ]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::bSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(2);
        
        $manager->persist($property);
        
        $property = new Property();
        $property->setName('Livret CMSO');
        $property->setReturnRate(2);
        $property->setAcquirementDate(new \DateTime('2014-04-05'));
        $property->setValue(120000);
        $acquirementType = $manager->getRepository(AcquirementType::class)->findOneBy(['identifier' => AcquirementType::beforeMarriage]);
        $property->setAcquirementTypes($acquirementType);
        $propertyType = $manager->getRepository(PropertyType::class)->findOneBy(['identifier' => PropertyType::aSaving]);
        $physicalPersons = $manager->getRepository(PhysicalPerson::class)->findByFirstName('Claudia');
        $property->addPhysicalPerson($physicalPersons[0]);
        
        $property->setPropertyTypes($propertyType);
        $property->setFeeling(5);
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