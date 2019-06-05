<?php

namespace App\Service;

use App\Event\HashLinkRedirectedEvent;
use App\Exception\InvalidCodeException;
use App\Repository\HashLinkRepositoryInterface;
use Hashids\Hashids;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RedirectService.
 */
class RedirectService
{
    /** @var Hashids */
    private $hashids;

    /** @var HashLinkRepositoryInterface $repository */
    private $hashLinkRepository;

    /** @var EventDispatcherInterface $dispatcher */
    private $dispatcher;

    /**
     * RedirectService constructor.
     * @param Hashids $hashids
     * @param HashLinkRepositoryInterface $hashLinkRepository
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        Hashids $hashids,
        HashLinkRepositoryInterface $hashLinkRepository,
        EventDispatcherInterface $dispatcher)
    {
        $this->hashids = $hashids;
        $this->hashLinkRepository = $hashLinkRepository;
        $this->dispatcher = $dispatcher;
    }


    /**
     * @param $code
     * @return null|RedirectResponse
     * @throws InvalidCodeException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRedirectResponse($code)
    {
        $ids = $this->hashids->decode($code);
        if (!isset($ids[0]) || !is_numeric($ids[0])) {
            throw new InvalidCodeException();
        }
        $id = $ids[0];

        $hashLink = $this->hashLinkRepository->findOneById($id);
        if (!$hashLink) {
            return null;
        }
        $event = new HashLinkRedirectedEvent($hashLink);
        $this->dispatcher->dispatch($event);

        return new RedirectResponse($hashLink->getLink());
    }
}
