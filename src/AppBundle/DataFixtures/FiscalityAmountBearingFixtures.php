<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use AppBundle\Entity\FiscalityAmountBearing;
use AppBundle\Entity\LawPosition;
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
        $constLawPostions = [
            LawPosition::commonCommunity,
            LawPosition::separatedProperty,
            LawPosition::participation,
            LawPosition::universalCommunity,
            LawPosition::movableCommunity,
            LawPosition::individedPacs,
            LawPosition::sibling,
            LawPosition::parent,
            LawPosition::child,
            LawPosition::uncleAunt,
            LawPosition::greatParent,
            LawPosition::greatChild,
            LawPosition::upToFourthDegree,
            LawPosition::beyondFourthDegree,
        ];
//         Life insurance

        foreach ($constLawPostions as $constLawPosition) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(152500);
            $fiscalityAmountBearing->setRate(0);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $constLawPosition));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
            
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(700000);
            $fiscalityAmountBearing->setRate(20);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $constLawPosition));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
            
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(null);
            $fiscalityAmountBearing->setRate(31,25);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $constLawPosition));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }

        
//         common law siblings
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(24430);
        $fiscalityAmountBearing->setRate(35);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::sibling));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);
        
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(45);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::sibling));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);
        
//         common law children
        $parentChildScales = [
            8072    => 5,
            12109   => 10,
            15932   => 15,
            552324  => 20,
            902838  => 30,
            1805677 => 40,
            null    => 45,            
        ];
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::child));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::parent));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }



//         between conjoints
        $spousePositions = [
            LawPosition::commonCommunity,
            LawPosition::individedPacs,
            LawPosition::movableCommunity,
            LawPosition::participation,
            LawPosition::separatedProperty,
            LawPosition::universalCommunity,            
        ];
        foreach($spousePositions as $spousePosition) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(null);
            $fiscalityAmountBearing->setRate(0);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $spousePosition));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
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