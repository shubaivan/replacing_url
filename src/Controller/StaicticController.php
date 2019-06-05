<?php

namespace App\Controller;

use App\Entity\HashLinkStatistic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaicticController extends AbstractController
{
    /**
     * @Route("/staictic", name="staictic")
     */
    public function index()
    {
        $all = $this->getDoctrine()
            ->getRepository(HashLinkStatistic::class)
            ->findAll();
        return $this->render('staictic/index.html.twig', [
            'hashLinkStatistics' => $all,
        ]);
    }
}
