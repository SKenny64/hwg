<?php

namespace App\Repository;

use App\Entity\ModePaiementTransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModePaiementTransport>
 *
 * @method ModePaiementTransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModePaiementTransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModePaiementTransport[]    findAll()
 * @method ModePaiementTransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModePaiementTransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModePaiementTransport::class);
    }

    //    /**
    //     * @return ModePaiementTransport[] Returns an array of ModePaiementTransport objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ModePaiementTransport
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
