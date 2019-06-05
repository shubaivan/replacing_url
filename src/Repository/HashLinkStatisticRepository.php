<?php

namespace App\Repository;

use App\Entity\HashLinkStatistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HashLinkStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashLinkStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashLinkStatistic[]    findAll()
 * @method HashLinkStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashLinkStatisticRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HashLinkStatistic::class);
    }

    // /**
    //  * @return HashLinkStatistic[] Returns an array of HashLinkStatistic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HashLinkStatistic
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
