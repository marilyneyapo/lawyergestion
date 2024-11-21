<?php

namespace App\Repository;

use App\Entity\Audience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Audience>
 *
 * @method Audience|null find($id, $lockMode = null, $lockVersion = null)
 * @method Audience|null findOneBy(array $criteria, array $orderBy = null)
 * @method Audience[]    findAll()
 * @method Audience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AudienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Audience::class);
    }

    public function add(Audience $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Audience $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * Retourne toutes les audiences triées par date
     * 
     * @return Audience[]
     */
    public function findAllOrderedByDate(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.date', 'ASC') // Utilisez 'DESC' pour un ordre décroissant
            ->getQuery()
            ->getResult();
    }
    /**
     * Récupère les audiences sans motif ou sans date de renvoi.
     *
     * @return Audience[]
     */
    public function findAudiencesSansResultats(): array
    {
        return $this->createQueryBuilder('a')
        ->leftJoin('a.renvois', 'r')  // Left join to include audiences with or without renvois
        ->where('a.motif IS NULL')   // Filter audiences where motif is null
        ->andWhere('r.dateRenvoi IS NULL')  // Filter audiences where renvoi's dateRenvoi is null
        ->orWhere('a.renvois IS EMPTY')  // This condition ensures the renvois collection is empty
        ->getQuery()
        ->getResult();
    }




//    /**
//     * @return Audience[] Returns an array of Audience objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Audience
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
