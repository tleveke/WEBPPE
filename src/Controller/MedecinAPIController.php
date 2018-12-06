<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\Medecin;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class MedecinAPIController extends AbstractController
{
    /**
     * @Route("/medecin/a/p/i", name="medecin_a_p_i")
     */
    public function index()
    {
        return $this->render('medecin_api/index.html.twig', [
            'controller_name' => 'MedecinAPIController',
        ]);
    }

    /**
     * @Route("/MedecinAPI", name="medecin_api", methods="GET|POST")
     */
    public function MedecinAPI(Request $request): Response
    {

        $user = $this->getUser();

        $rapports = $this->getDoctrine()
                ->getRepository(Rapport::class)
                ->findBy(['idvisiteur' => $user->getId()]);
        
        /* @var $rapports Rapport[] */
        
        $medecins = [];
        foreach ($rapports as $rapport) {
            $medecins[] = [ 
                'id' => $rapport->getIdMedecin()->getId(),
                'nom' => $rapport->getIdMedecin()->getNom(),
                'prenom' => $rapport->getIdMedecin()->getPrenom(),
                'adresse' => $rapport->getIdMedecin()->getAdresse(),
                'departement' => $rapport->getIdMedecin()->getDepartement(),
                'codePostal' => $rapport->getIdMedecin()->getCodepostal(),
                'ville' => $rapport->getIdMedecin()->getVille(),
                'latitude' => $rapport->getIdMedecin()->getLatitude(),
                'longitude' => $rapport->getIdMedecin()->getLongitude(),
                'tel' => $rapport->getIdMedecin()->getTel(),
                'specialitecomplementaire' => $rapport->getIdMedecin()->getSpecialitecomplementaire(),
            ];
        }
        

        return new JsonResponse($medecins);
    }
}
