<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\LawPosition;
use AppBundle\Entity\LiquidationFiscality;

class LiquidationFiscalityFixtures extends Fixture implements ORMFixtureInterface

{

/**
 * 
 * {@inheritDoc}
 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
 */
    public function load(ObjectManager $manager)
    {
            $liquidationFiscality = new LiquidationFiscality();
            $liquidationFiscality->setName('Assurance Vie');
            $liquidationFiscality->setIdentifier(LiquidationFiscality::lifeInsurance);
            $manager->persist($liquidationFiscality);
        
        
            $liquidationFiscality = new LiquidationFiscality();
            $liquidationFiscality->setName('Succession');
            $liquidationFiscality->setIdentifier(LiquidationFiscality::inherit);
            $manager->persist($liquidationFiscality);
        

        $manager->flush();       
    }
    
   
}