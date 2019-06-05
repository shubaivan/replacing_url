<?php

namespace App\Controller;

use App\Exception\InvalidCodeException;
use App\Service\RedirectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends AbstractController
{
    /**
     * @var RedirectService
     */
    private $reductionUrlService;

    /**
     * RedirectController constructor.
     * @param RedirectService $reductionUrlService
     */
    public function __construct(RedirectService $reductionUrlService)
    {
        $this->reductionUrlService = $reductionUrlService;
    }

    /**
     * @param $code
     * @return null|RedirectResponse
     * @throws InvalidCodeException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction($code)
    {
        $response = $this->reductionUrlService->getRedirectResponse($code);
        if (null === $response) {
            throw new InvalidCodeException();
        }

        return $response;
    }
}
