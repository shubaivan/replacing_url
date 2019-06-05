<?php

namespace App\Controller;

use App\Factory\HashLinkFactory;
use App\Service\EncodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EncodeController extends AbstractController
{
    /**
     * @var EncodeService
     */
    private $encodeService;

    /**
     * @var HashLinkFactory
     */
    private $hashLinkFactory;

    /**
     * EncodeController constructor.
     * @param EncodeService $encodeService
     * @param HashLinkFactory $hashLinkFactory
     */
    public function __construct(EncodeService $encodeService, HashLinkFactory $hashLinkFactory)
    {
        $this->encodeService = $encodeService;
        $this->hashLinkFactory = $hashLinkFactory;
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse|string
     */
    public function indexAction(Request $request)
    {
        try {
            $url = $request->request->get('url');
            $shortUrl = $this->hashLinkFactory->create($url);
            $shortUrl = $this->encodeService->process($shortUrl);

            return $this->render(
                '_partial/_part_url.html.twig',
                [
                    'url' => $shortUrl,
                ]
            );
        } catch (\Exception $exception) {
            return new JsonResponse(['msg' => $exception->getMessage()], 400);
        }
    }
}
