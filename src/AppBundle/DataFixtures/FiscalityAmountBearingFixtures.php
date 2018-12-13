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
        $lifeInsuranceScales = [
            152500 => 0,
            700000 => 20,
            null   => 31.25,
        ];
        foreach ($constLawPostions as $constLawPosition) {
            foreach($lifeInsuranceScales as $amountScale => $rate) {
                
            }
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $constLawPosition));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
            
        }

//         common law siblings
        $lifeInsuranceScales = [
            24430 => 35,
            null  => 45,
        ];
        foreach ($lifeInsuranceScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::sibling));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
//         common law children / parents
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
        
//         up to fourth degree
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(55);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::upToFourthDegree));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);
        
//         beyound fourth degree
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(null);
        $fiscalityAmountBearing->setRate(60);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->addLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::beyondFourthDegree));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
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