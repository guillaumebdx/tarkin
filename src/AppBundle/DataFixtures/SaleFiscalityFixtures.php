<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\SaleFiscality;


class SaleFiscalityFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Assurance vie');
        $saleFiscality->setIdentifier('life-insurance');
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Capital décés');
        $saleFiscality->setIdentifier('death-insurance');
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Immobilier');
        $saleFiscality->setIdentifier('real-estate');
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('Financier');
        $saleFiscality->setIdentifier('financial');
        $manager->persist($saleFiscality);
        
        $saleFiscality = new SaleFiscality();
        $saleFiscality->setName('PEA');
        $saleFiscality->setIdentifier('pea');
        $manager->persist($saleFiscality);
        
        
        $manager->flush();
    }
    
    
}