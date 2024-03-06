<?php

namespace App\Repository;

use App\Entity\CoordonneesUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoordonneesUtilisateur>
 *
 * @method CoordonneesUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordonneesUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordonneesUtilisateur[]    findAll()
 * @method CoordonneesUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordonneesUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoordonneesUtilisateur::class);
    }

    //    /**
    //     * @return CoordonneesUtilisateur[] Returns an array of CoordonneesUtilisateur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CoordonneesUtilisateur
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
