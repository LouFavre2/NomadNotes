<?php

namespace App\Repository;

use App\Entity\PlaceMemo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceMemo>
 *
 * @method PlaceMemo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceMemo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceMemo[]    findAll()
 * @method PlaceMemo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceMemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceMemo::class);
    }

//    /**
//     * @return PlaceMemo[] Returns an array of PlaceMemo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlaceMemo
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
