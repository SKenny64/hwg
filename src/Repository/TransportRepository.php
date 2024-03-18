<?php

namespace App\Repository;

use App\Entity\Transport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transport>
 *
 * @method Transport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transport[]    findAll()
 * @method Transport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transport::class);
    }

       /**
        * @return Transport[] Returns an array of Transport objects
        */
       public function findByEvents($value): array
       {
           return $this->createQueryBuilder('t')
               ->andWhere('t.evenement = :val')
               ->setParameter('val', $value)
               ->orderBy('t.id', 'ASC')
               ->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }

    public function findEvent($id): ?Transport
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.evenement = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }
}
