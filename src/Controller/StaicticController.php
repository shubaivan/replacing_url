<?php

namespace App\Controller;

use App\Entity\HashLink;
use App\Entity\HashLinkStatistic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaicticController extends AbstractController
{
    /**
     * @Route("/staictic/{id}", name="staictic")
     */
    public function index(HashLink $hashLink)
    {
        $all = $this->getDoctrine()
            ->getRepository(HashLinkStatistic::class)
            ->findBy(['hashLinkId' => $hashLink]);
        return $this->render('staictic/index.html.twig', [
            'hashLinkStatistics' => $all,
        ]);
    }
}
