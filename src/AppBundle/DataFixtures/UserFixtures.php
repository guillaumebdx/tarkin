<?php 
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;

class UserFixtures extends Fixture implements ORMFixtureInterface

{


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('guillaumeharari@hotmail.com');
        $user->setEmailCanonical('guillaumeharari@hotmail.com');
        $user->setNameReference('Harari');
        $user->setPassword('root');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('henridupont@hotmail.com');
        $user->setEmailCanonical('henridupont@hotmail.com');
        $user->setNameReference('Dupont');
        $user->setPassword('root');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('demo@demo.com');
        $user->setEmailCanonical('demo@demo.com');
        $user->setNameReference('Démo');
        $user->setPassword('demo');
        $manager->persist($user);
        $manager->flush();
    }
    
    
}