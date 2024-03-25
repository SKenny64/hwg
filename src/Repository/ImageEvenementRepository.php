<?php

namespace App\Repository;

use App\Entity\ImageEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageEvenement>
 *
 * @method ImageEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageEvenement[]    findAll()
 * @method ImageEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageEvenement::class);
    }

   /**
    * @return ImageEvenement[] Returns an array of ImageEvenement objects
    */
   public function findByCouverture(): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.couverture = :val')
           ->setParameter('val', true)
           ->orderBy('i.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findEvent($id): ?ImageEvenement
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.evenement = :val')
           ->setParameter('val', $id)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

    public function findBySearchTerm($searchTerm): iterable
    {
        return $this->createQueryBuilder('i')
            ->innerJoin("i.evenement", "e")
            ->Where('e.nomEvenement LIKE :search')
            ->setParameter('search', '%'.$searchTerm.'%')
            ->getQuery()
            ->getResult();
    }
    
    public function findBySearchDate($searchTerm): iterable
    {
        return $this->createQueryBuilder('i')
            ->innerJoin("i.evenement", "e")
            ->Where('e.dateEvenement LIKE :search')
            ->setParameter('search', '%'.$searchTerm.'%')
            ->getQuery()
            ->getResult();
    } 

   public function findByCategory($id): array
   {
        return $this->createQueryBuilder('i')
            ->innerJoin("i.evenement", "e")
            ->where("e.categorie = :val")
            ->setParameter('val', $id)
            // ->addOrderBy('i.dateAjout', 'DESC')
            ->getQuery()
            ->getResult();
   }

   public function findBySearchTermAndStatus($term, $status = 'Validé', $currentDate = new \DateTime())
{
    $qb = $this->createQueryBuilder('i')
        ->leftJoin('i.evenement', 'e')
        ->where('e.nomEvenement LIKE :term')
        ->setParameter('term', '%'.$term.'%');

    if ($status) {
        $qb->andWhere('e.statusEvenement = :status')
            ->setParameter('status', $status);
    }

    $qb->andWhere('e.dateEvenement > :currentDate')
        ->setParameter('currentDate', $currentDate)
        ->setMaxResults(8);

    return $qb->getQuery()->getResult();
}
}
