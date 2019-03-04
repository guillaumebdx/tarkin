<?php 
namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PriorityType;



class PriorityTypeFixtures extends Fixture

{


    public function load(ObjectManager $manager)
    {
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::INCOME_FISCALITY);
        $priorityType->setName('Fiscalité des revenus');
        $manager->persist($priorityType);
        
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::INHERIT);
        $priorityType->setName('Succession');
        $manager->persist($priorityType);
        
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::LONG_TERM);
        $priorityType->setName('Rentabilité long terme');
        $manager->persist($priorityType);
        
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::SHORT_TERM);
        $priorityType->setName('Rentabilité court terme');
        $manager->persist($priorityType);
        
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::RETIREMENT);
        $priorityType->setName('Retraite');
        $manager->persist($priorityType);
        
        $priorityType = new PriorityType();
        $priorityType->setIdentifier(PriorityType::WEALTH_FISCALITY);
        $priorityType->setName('Fiscalité IFI');
        $manager->persist($priorityType);

        
        
        $manager->flush();
    }
    
    
}