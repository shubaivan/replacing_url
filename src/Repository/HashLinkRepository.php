<?php

namespace App\Repository;

use App\Entity\HashLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HashLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashLink[]    findAll()
 * @method HashLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashLinkRepository extends ServiceEntityRepository implements HashLinkRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HashLink::class);
    }

    /**
     * @param int $id
     * @return HashLink
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('hash_link');
        $qb->where('hash_link.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $url
     * @return HashLink
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUrl(string $url)
    {
        $qb = $this->createQueryBuilder('hash_link');
        $qb->where('hash_link.link = :link')
            ->setParameter('link', $url);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param HashLink $hashLink
     * @return HashLink
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(HashLink $hashLink)
    {
        $this->_em->persist($hashLink);
        $this->_em->flush($hashLink);

        return $hashLink;
    }
}
