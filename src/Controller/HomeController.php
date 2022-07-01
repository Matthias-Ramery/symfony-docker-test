<?php

namespace App\Controller;

use App\Entity\ListRappel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ListType;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $listRappel = new ListRappel();

        //création du formulaire et initialisation du résultat dans $message
        $form = $this->createForm(ListType::class, $listRappel);
        $form->handleRequest($request);


        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
