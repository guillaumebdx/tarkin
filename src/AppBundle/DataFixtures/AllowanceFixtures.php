<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use AppBundle\Entity\Allowance;
use AppBundle\Entity\LawPosition;


class AllowanceFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $allowance = new Allowance();
        $allowance->setValue(100000);
        $allowance->setIdentifier('first');
        $manager->persist($allowance);
        
        $allowance = new Allowance();
        $allowance->setValue(15932);
        $allowance->setIdentifier('second');
        $manager->persist($allowance);
        
        $allowance = new Allowance();
        $allowance->setValue(7967);
        $allowance->setIdentifier('third');
        $manager->persist($allowance);
        
     
        $allowance = new Allowance();
        $allowance->setValue(1594);
        $allowance->setIdentifier('fourth');
        $manager->persist($allowance);
        
        $manager->flush();
    }
    
    
}