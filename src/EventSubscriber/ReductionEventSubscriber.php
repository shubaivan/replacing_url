<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Event\HashLinkCreatedEvent;
use App\Event\HashLinkRedirectedEvent;
use App\Factory\HashLinkStatisticFactory;
use App\Repository\HashLinkRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ReductionEventSubscriber implements EventSubscriberInterface
{
    /**
     * ReductionEventSubscriber constructor.
     * @param HashLinkRepository $hashLinkRepository
     * @param TokenStorage $tokenStorage
     * @param HashLinkStatisticFactory $hashLinkStatisticFactory
     */
    public function __construct(
        HashLinkRepository $hashLinkRepository,
        TokenStorageInterface $tokenStorage,
        HashLinkStatisticFactory $hashLinkStatisticFactory
    ) {
        $this->hashLinkRepository = $hashLinkRepository;
        $this->tokenStorage = $tokenStorage;
        $this->hashLinkStatisticFactory = $hashLinkStatisticFactory;
    }


    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            HashLinkRedirectedEvent::class => 'onRedirected',
            HashLinkCreatedEvent::class => 'onCreated'
        ];
    }

    /** @var HashLinkRepository */
    private $hashLinkRepository;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var HashLinkStatisticFactory $hashLinkStatisticFactory
     */
    private $hashLinkStatisticFactory;

    /**
     * @param HashLinkCreatedEvent $event
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function onCreated(HashLinkCreatedEvent $event)
    {
        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        if ($user instanceof User) {
            $event->getHashLink()->setCreatedBy($user);
            $this->hashLinkRepository->save($event->getHashLink());
        }
    }

    /**
     * @param HashLinkRedirectedEvent $event
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function onRedirected(HashLinkRedirectedEvent $event)
    {
        $hashLink = $event->getHashLink();
        $hashLink->addHashLinkStatistic($this->hashLinkStatisticFactory->create());
        $this->hashLinkRepository->save($hashLink);
    }
}
