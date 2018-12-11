<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use AppBundle\Entity\FiscalityAmountBearing;
use AppBundle\Entity\LiquidationFiscality;

class FiscalityAmountBearingFixtures extends Fixture implements DependentFixtureInterface

{

/**
 * 
 * {@inheritDoc}
 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
 */
    public function load(ObjectManager $manager)
    {
//         Life insurance
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(152500);
        $fiscalityAmountBearing->setRate(0);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
        
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(700000);
        $fiscalityAmountBearing->setRate(20);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
        
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(31,25);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
     
        
        
//         common law siblings
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(24430);
        $fiscalityAmountBearing->setRate(35);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
        
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(45);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
        
//         between conjoints
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(0);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $manager->persist($fiscalityAmountBearing);
        
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
            FiscalityYearBearingFixtures::class,
            LiquidationFiscalityFixtures::class,
        );
    }
    
}