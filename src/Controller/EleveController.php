<?php
namespace App\Controller;

use App\Entity\ELEVE;
use App\Form\EleveType;
use App\Repository\ELEVERepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EleveController extends AbstractController
{
    #[Route('/', name: 'app_eleves')]
    public function index(
        ELEVERepository $eleveRepository,
        PaginatorInterface $paginator,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Pagination
        $search = $request->query->get('search', '');

        $query = $eleveRepository->createQueryBuilder('e')
            ->where('e.nom_eleve LIKE :search OR e.prenom_eleve LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery();
            
        $eleves = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        // Create form
        $eleve = new ELEVE();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Manual increment ID
            $maxId = $eleveRepository->createQueryBuilder('e')
                ->select('MAX(e.id_eleve)')
                ->getQuery()
                ->getSingleScalarResult();
            $eleve->setIdEleve(($maxId ?? 0) + 1);

            // Register date = today
            $eleve->setDateInscription(new \DateTime());

            $em->persist($eleve);
            $em->flush();

            return $this->redirectToRoute('app_eleves');
        }

        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleves,
            'form' => $form,
        ]);
    }

    #[Route('/eleves/update/{id}', name: 'app_eleves_update', methods: ['POST'])]
    public function update(int $id, Request $request, ELEVERepository $eleveRepository, EntityManagerInterface $em): Response
    {
        $eleve = $eleveRepository->find($id);
        $champ = $request->request->get('champ');
        $valeur = (bool) $request->request->get('valeur');

        if ($champ === 'code') {
            $eleve->setCode($valeur);
        } elseif ($champ === 'conduite') {
            $eleve->setConduite($valeur);
        }

        $em->flush();
        return $this->redirectToRoute('app_eleves');
    }
}