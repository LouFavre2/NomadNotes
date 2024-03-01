<?php

namespace App\Repository;

use App\Entity\Memo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Memo>
 *
 * @method Memo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Memo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Memo[]    findAll()
 * @method Memo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Memo::class);
    }

    /**
    * recupere tous les memos et les details associés (jointure photo et place) 
    * @return Memo[] Returns an array of Memo objects
    */
    public function findMemosByUser($user): array
    {
        return $this->createQueryBuilder('m')
            ->select('m', 'place', 'photo')
            ->leftJoin('m.place', 'place')
            ->leftJoin('m.photos', 'photo')
            ->where('m.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
        ;
    }

    //    public function findOneBySomeField($value): ?Memo
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
