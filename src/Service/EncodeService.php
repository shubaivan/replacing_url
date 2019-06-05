<?php

namespace App\Service;

use App\Entity\HashLink;
use App\Event\HashLinkCreatedEvent;
use App\Event\ShortUrlEvent;
use App\Repository\HashLinkRepositoryInterface;
use Hashids\Hashids;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EncodeService.
 */
class EncodeService
{
    /** @var Hashids */
    private $hashids;

    /** @var HashLinkRepositoryInterface */
    private $hashLinkRepositoryInterface;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /**
     * EncodeService constructor.
     * @param Hashids $hashids
     * @param HashLinkRepositoryInterface $hashLinkRepositoryInterface
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        Hashids $hashids, 
        HashLinkRepositoryInterface $hashLinkRepositoryInterface, 
        EventDispatcherInterface $dispatcher
    ) {
        $this->hashids = $hashids;
        $this->hashLinkRepositoryInterface = $hashLinkRepositoryInterface;
        $this->dispatcher = $dispatcher;
    }


    /**
     * @param HashLink $hashLink
     *
     * @throws \Exception
     *
     * @return HashLink
     */
    public function process(HashLink $hashLink)
    {
        $existentShortUrl = $this->hashLinkRepositoryInterface
            ->findOneByUrl($hashLink->getLink());
        if ($existentShortUrl) {
            throw new \Exception('exist link');
        }
        $this->hashLinkRepositoryInterface->save($hashLink);

        $hashLinkId = $hashLink->getId();
        $hash = $this->hashids->encode($hashLinkId);

        $hashLink->setHash($hash);
        $hashLink = $this->hashLinkRepositoryInterface->save($hashLink);

        $event = new HashLinkCreatedEvent($hashLink);
        $this->dispatcher->dispatch($event);

        return $hashLink;
    }
}
