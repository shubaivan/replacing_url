<?php

namespace App\Controller;

use App\Repository\HashLinkRepository;
use App\Form\UrlType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @var HashLinkRepository
     */
    private $hashLinkRepository;

    /**
     * IndexController constructor.
     * @param HashLinkRepository $hashLinkRepository
     */
    public function __construct(HashLinkRepository $hashLinkRepository)
    {
        $this->hashLinkRepository = $hashLinkRepository;
    }

    /**
     * @Route("/", name="home_index")
     */
    public function home()
    {
        if ($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN')) {
            return $this->renderIndexData();
        }

        return $this->render('home/index.html.twig', []);
    }

    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->renderIndexData();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function renderIndexData(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('index/index.html.twig', [
            'urls' => $this->hashLinkRepository->findAll(),
            'form' => $this->createForm(
                UrlType::class,
                null,
                [
                    'action' => '#',
                    'attr' => array('style' => 'height: 20px;')
                ]
            )->createView(),
        ]);
    }
}
