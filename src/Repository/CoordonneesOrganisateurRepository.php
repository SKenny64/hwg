<?php

namespace App\Repository;

use App\Entity\CoordonneesOrganisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoordonneesOrganisateur>
 *
 * @method CoordonneesOrganisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordonneesOrganisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordonneesOrganisateur[]    findAll()
 * @method CoordonneesOrganisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordonneesOrganisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoordonneesOrganisateur::class);
    }

    //    /**
    //     * @return CoordonneesOrganisateur[] Returns an array of CoordonneesOrganisateur objects
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

    //    public function findOneBySomeField($value): ?CoordonneesOrganisateur
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
