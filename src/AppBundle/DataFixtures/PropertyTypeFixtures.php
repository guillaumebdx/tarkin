<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PropertyType;
use AppBundle\Entity\SaleFiscality;
use AppBundle\Entity\InterestFiscality;
use AppBundle\Entity\LiquidationFiscality;



class PropertyTypeFixtures extends Fixture implements DependentFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $propertyType = new PropertyType();
        $propertyType->setName('Livret A');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::aSaving);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        
        $propertyType = new PropertyType();
        $propertyType->setName('Livret B');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::bSaving);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Logement');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pel);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Action');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pea);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::pea));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Compte titres');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::sharesAccount);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Assurance Vie');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::lifeInsurance);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::lifeInsurance));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('PERCO');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::perco);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Plan Epargne Entreprise');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::pee);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('FCPI');
        $propertyType->setFinancial(true);
        $propertyType->setIdentifier(PropertyType::fcpi);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::financial));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('SCPI');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier('scpi');
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::realEstate));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Résidence Principale');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier(PropertyType::principalResidence);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::realEstate));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        $propertyType = new PropertyType();
        $propertyType->setName('Bien locatif');
        $propertyType->setFinancial(false);
        $propertyType->setIdentifier(PropertyType::rentalProperty);
        $saleFiscality = $manager->getRepository(SaleFiscality::class)->findOneBy(array('identifier' => SaleFiscality::realEstate));
        $propertyType->setSaleFiscality($saleFiscality);
        $manager->persist($propertyType);
        
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            SaleFiscalityFixtures::class,
            InterestFiscalityFixtures::class,
        );
    }

    
    
}