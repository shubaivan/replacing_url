<?php

namespace App\Repository;

use App\Entity\HashLink;

/**
 * Interface HashLinkRepositoryInterface.
 */
interface HashLinkRepositoryInterface
{
    /**
     * @param int $id
     * @return HashLink
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById(int $id);

    /**
     * @param $url
     * @return HashLink
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUrl(string $url);

    /**
     * @param HashLink $hashLink
     * @return HashLink
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(HashLink $hashLink);
}
