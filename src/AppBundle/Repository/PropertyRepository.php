<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PhysicalPerson;

/**
 * PropertyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PropertyRepository extends \Doctrine\ORM\EntityRepository
{


    public function findByPhysicalPerson(PhysicalPerson $physicalPerson)
    {
        $query = $this->createQueryBuilder('a')
        ->select('a')
        ->leftJoin('a.physicalPersons', 'c')
        ->addSelect('c');
        
        $query = $query->add('where', $query->expr()->in('c', ':c'))
        ->setParameter('c', $physicalPerson)
        ->getQuery()
        ->getResult();
        
        return $query;
    }


}
