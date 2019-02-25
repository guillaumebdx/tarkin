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

        $constLawPositions = [
            LawPosition::beyondFourthDegree,
            LawPosition::child,
            LawPosition::cohabitPartner,
            LawPosition::greatChild,
            LawPosition::greatParent,
            LawPosition::nephew,
            LawPosition::parent,
            LawPosition::sibling,
            LawPosition::uncleAunt,
            LawPosition::upToFourthDegree,
            
        ];

        $lifeInsuranceScales = [
            0      => 0,
            152500 => 20,
            700000 => 31.25,
        ];
        foreach ($constLawPositions as $constLawPosition) {
            foreach ($lifeInsuranceScales as $amountScale => $rate) {
                $fiscalityAmountBearing = new FiscalityAmountBearing();
                $fiscalityAmountBearing->setAmount($amountScale);
                $fiscalityAmountBearing->setRate($rate);
                $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
                $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
                $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $constLawPosition));
                $fiscalityAmountBearing->setLawPositions($lawPosition);
                $manager->persist($fiscalityAmountBearing);
            }
        }

        

//         common law siblings
        $siblingScales = [
            0     => 35,
            24430 => 45,
        ];
        foreach ($siblingScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::sibling));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
//         common law children / parents
        $parentChildScales = [
            0       => 5,
            8072    => 10,
            12109   => 15,
            15932   => 20,
            552324  => 30,
            902838  => 40,
            1805677 => 45,
        ];
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::parent));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::child));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::greatChild));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
        foreach ($parentChildScales as $amountScale => $rate) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount($amountScale);
            $fiscalityAmountBearing->setRate($rate);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::greatParent));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
        }
        
        

//         between conjoints
        $spousePositions = [
            LawPosition::commonCommunity,
            LawPosition::individedPacs,
            LawPosition::separatedPacs,
            LawPosition::movableCommunity,
            LawPosition::participation,
            LawPosition::separatedProperty,
            LawPosition::universalCommunity,            
        ];
        foreach ($spousePositions as $lawIdentifier) {
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(0);
            $fiscalityAmountBearing->setRate(0);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $lawIdentifier));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
            
            $fiscalityAmountBearing = new FiscalityAmountBearing();
            $fiscalityAmountBearing->setAmount(0);
            $fiscalityAmountBearing->setRate(0);
            $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::lifeInsurance));
            $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
            $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => $lawIdentifier));
            $fiscalityAmountBearing->setLawPositions($lawPosition);
            $manager->persist($fiscalityAmountBearing);
            
        }
        
        //up to fourth degree
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(0);
        $fiscalityAmountBearing->setRate(55);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::upToFourthDegree));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);

   
        
        //cohabit partner
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(0);
        $fiscalityAmountBearing->setRate(60);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::cohabitPartner));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);
        
        //uncle aunt
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(0);
        $fiscalityAmountBearing->setRate(55);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::uncleAunt));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);
        
        //nephew
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(0);
        $fiscalityAmountBearing->setRate(55);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
        $lawPosition   = $manager->getRepository(LawPosition::class)->findOneBy(array('identifier' => LawPosition::nephew));
        $fiscalityAmountBearing->setLawPositions($lawPosition);
        $manager->persist($fiscalityAmountBearing);

        //beyond fourth degree    
        $fiscalityAmountBearing = new FiscalityAmountBearing();
        $fiscalityAmountBearing->setAmount(0);
        $fiscalityAmountBearing->setRate(60);
        $liquidationFiscality = $manager->getRepository(LiquidationFiscality::class)->findOneBy(array('identifier' => LiquidationFiscality::inherit));
        $fiscalityAmountBearing->setLiquidationFiscality($liquidationFiscality);
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
            LawPositionFixtures::class, 
        );
    }
    
}