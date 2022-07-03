<?php

namespace App\Controller;

use App\Entity\ListRappel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'app_list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $listRappel = $entityManager->getRepository(ListRappel::class)->findAll();

        return $this->render('list/index.html.twig', [
            'listRappel' => $listRappel,
        ]);
    }
}
