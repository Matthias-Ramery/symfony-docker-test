<?php

namespace App\Controller;

use App\Entity\ListRappel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpClient\HttpClient;
use App\Form\ListType;

class HomeController extends AbstractController
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create([
            'auth_basic' => ['api', 'azpihviyazfb']
        ]);
    }

    #[Route('', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $listRappel = new ListRappel();

        //création du formulaire et initialisation du résultat dans $message
        $form = $this->createForm(ListType::class, $listRappel);
        $form->handleRequest($request);

        //si le formulaire est valide est s'il est envoyé
        if($form->isSubmitted() && $form->isValid()) {

            $this->verifyPhoneNumber($form->getData());
            $listRappel->phoneNumberInternational = "+33" . $listRappel->phoneNumberNational;

            //enregistrement en bdd
            $entityManager->persist($listRappel);
            $entityManager->flush();

            //redirection vers la route 'success'
            return $this->redirectToRoute('app_success');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function verifyPhoneNumber($params): array{
        //vérification du numéro de téléphone
        $response = $this->httpClient->request(
            'POST',
            'http://tst.oliverstore.com:3000/api/v1/validate', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode(array(
                    'phoneNumber'=> $params->phoneNumberNational,
                    'countryCode'=> $params->countryCode->code
                ))
            ]
        );
        dd($response);
    }
}
