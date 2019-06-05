<?php

namespace App\Factory;

use App\Entity\HashLinkStatistic;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class HashLinkStatisticFactory.
 */
class HashLinkStatisticFactory
{
    /** @var HashLinkStatistic */
    protected $hashLinkStatistic;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * HashLinkStatisticFactory constructor.
     * @param $hashLinkStatistic
     * @param TokenStorage $tokenStorage
     * @param RequestStack $requestStack
     */
    public function __construct(
        $hashLinkStatistic,
        TokenStorageInterface $tokenStorage,
        RequestStack $requestStack
    )
    {
        $this->hashLinkStatistic = new $hashLinkStatistic();;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
    }

    /**
     * @return HashLinkStatistic
     */
    public function create()
    {
        $this->hashLinkStatistic
            ->setUserAgent(
                $this->requestStack->getCurrentRequest()->headers->get('User-Agent')
            );
        $this->hashLinkStatistic->setApi(
            $this->requestStack->getCurrentRequest()->getClientIp()
        );

        return $this->hashLinkStatistic;
    }
}
