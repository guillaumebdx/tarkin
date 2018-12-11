<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\SaleFiscality;
use AppBundle\Entity\LawPosition;


class SaleFiscalityFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Assurance vie');
        $saleFiscality->setIdentifier(SaleFiscality::lifeInsurance);
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Capital décés');
        $saleFiscality->setIdentifier(SaleFiscality::deathInsurance);
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Immobilier');
        $saleFiscality->setIdentifier(SaleFiscality::realEstate);
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Financier');
        $saleFiscality->setIdentifier(SaleFiscality::financial);
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('PEA');
        $saleFiscality->setIdentifier(SaleFiscality::pea);
        $manager->persist($saleFiscality);
        
        
        $manager->flush();
    }
    
    
}