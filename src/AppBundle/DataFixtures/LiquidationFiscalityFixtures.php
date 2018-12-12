<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use AppBundle\Entity\LawPosition;
use AppBundle\Entity\LiquidationFiscality;

class LiquidationFiscalityFixtures extends Fixture implements DependentFixtureInterface

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
    
/**
 * 
 * {@inheritDoc}
 * @see \Doctrine\Common\DataFixtures\DependentFixtureInterface::getDependencies()
 */
    public function getDependencies()
    {
        return array(
            LawPositionFixtures::class,
        );
    }
    
}