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
        $user->setNameReference('Coupé');
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
        
        $user = new User();
        $user->setEmail('thib@ult.di');
        $user->setEmailCanonical('thib@ult.di');
        $user->setNameReference('Diarra');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('thib@ult.di');
        $user->setEmailCanonical('thib@ult.di');
        $user->setNameReference('Diarra');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST CELIB');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST PACS');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST SEPARATION DE BIENS');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST REGIME LEGAL');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST COMM UNIV');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('a@a.fr');
        $user->setEmailCanonical('a@a.fr');
        $user->setNameReference('TEST CONCUBIN');
        $user->setPassword('demo');
        $manager->persist($user);
        
        $manager->flush();
    }
    
    
}