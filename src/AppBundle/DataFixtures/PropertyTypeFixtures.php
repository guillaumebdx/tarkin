<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\PropertyType;



class PropertyTypeFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $propertyType = new PropertyType();
        $propertyType->setName('Livret A');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::aSaving);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Livret B');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::bSaving);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Logement');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pel);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Action');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pea);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Compte titres');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::sharesAccount);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Assurance Vie');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::lifeInsurance);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('PERCO');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::perco);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Entreprise');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pee);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('FCPI');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::fcpi);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('SCPI');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier('scpi');
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Résidence Principale');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier(PropertyType::principalResidence);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Bien locatif');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier(PropertyType::rentalProperty);
        $manager->persist($propertyType);
        
        
        $manager->flush();
    }
    
    
}