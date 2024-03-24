<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

   /**
    * @return Reservation[] Returns an array of Reservation objects
    */
    public function findByUser($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
 
       /**
     * @return Reservation[] Returns an array of Reservation objects
     */
     public function findByTransport($value): array
     {
         return $this->createQueryBuilder('p')
             ->andWhere('p.transport = :val')
             ->setParameter('val', $value)
             ->getQuery()
             ->getResult()
         ;
     }

     public function countByTransport($transportId): int
     {
         return $this->createQueryBuilder('r')
             ->select('COUNT(r.id)')
             ->andWhere('r.transport = :transport')
             ->setParameter('transport', $transportId)
             ->getQuery()
             ->getSingleScalarResult();
     }
 
}
