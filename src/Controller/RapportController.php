<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\Search;
use App\Entity\Offrir;
use App\Entity\Visiteur;
use App\Entity\Medecin;

use App\Form\RapportType;
use App\Form\SearchType;
use App\Form\OffrirType;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/rapport")
 */
class RapportController extends AbstractController
{
    /**
     * @Route("/", name="rapport_index", methods="GET|POST")
     */
    public function index(Request $request): Response
    {

        $search = new Search;
        $searchform = $this->createForm(SearchType::class, $search);

        $user = $this->getUser();

        $searchform->handleRequest($request);
        if ($searchform->isSubmitted() && $searchform->isValid() ) {

            $rapports = $this->getDoctrine()
                ->getRepository(Rapport::class)
                ->finAllOrderedByDate($search,$user);
        }
        else {
            $rapports = $this->getDoctrine()
                ->getRepository(Rapport::class)
                ->findBy(['idvisiteur' => $user->getId()]);
        }

        return $this->render('rapport/index.html.twig', [
            'rapports' => $rapports,
            'search' => $searchform->createView(),
        ]);
    }

    /**
     * @Route("/new", name="rapport_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $rapport = new Rapport();
        foreach ($rapport->getOffrirs() as $offrir) {
            $orignalOffrirs->add($offrir);
        }
        $rapport->setIdvisiteur($this->getUser());
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($rapport);
            $em->flush();

            return $this->redirectToRoute('rapport_index');
        }

        return $this->render('rapport/new.html.twig', [
            'rapport' => $rapport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rapport_show", methods="GET")
     */
    public function show(Rapport $rapport): Response
    {
        $offrirs = $rapport->getOffrirs();

        return $this->render('rapport/show.html.twig', [
            'rapport' => $rapport,
            'echantillons' => $offrirs
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rapport_edit", methods="GET|POST")
     */
    public function edit(Request $request, Rapport $rapport): Response
    {
        $orignalOffrirs = new ArrayCollection();
        foreach ($rapport->getOffrirs() as $offrir) {
            $orignalOffrirs->add($offrir);
        }

        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();

            foreach ($orignalOffrirs as $offrir) {
                 // check if the exp is in the $user->getExp()
                //dump($user->getExp()->contains($exp));
                if ($rapport->getOffrirs()->contains($offrir) === false) {
                    $em->remove($offrir);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rapport_edit', ['id' => $rapport->getId()]);
        }

        return $this->render('rapport/edit.html.twig', [
            'rapport' => $rapport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rapport_delete", methods="DELETE")
     */
    public function delete(Request $request, Rapport $rapport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapport->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rapport);
            $em->flush();
        }

        return $this->redirectToRoute('rapport_index');
    }

}
