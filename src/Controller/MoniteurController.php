<?php

namespace App\Controller;

use App\Entity\MONITEUR;
use App\Form\MoniteurType;
use App\Repository\MONITEURRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

final class MoniteurController extends AbstractController
{
    #[Route('/moniteurs', name: 'app_moniteurs')]
    public function index(
        MONITEURRepository $moniteurRepository,
        PaginatorInterface $paginator,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Pagination
        $search = $request->query->get('search', '');

        $query = $moniteurRepository->createQueryBuilder('m')
            ->where('m.nom_moniteur LIKE :search OR m.prenom_moniteur LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery();
            
        $moniteurs = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        // Create form
        $moniteur = new MONITEUR();
        $form = $this->createForm(MoniteurType::class, $moniteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Manual increment ID
            $maxId = $moniteurRepository->createQueryBuilder('m')
                ->select('MAX(m.id_moniteur)')
                ->getQuery()
                ->getSingleScalarResult();
            $moniteur->setIdMoniteur(($maxId ?? 0) + 1);

            $em->persist($moniteur);
            $em->flush();

            return $this->redirectToRoute('app_moniteurs');
        }

        return $this->render('moniteur/index.html.twig', [
            'moniteurs' => $moniteurs,
            'form' => $form,
        ]);
    }

    #[Route('/moniteurs/update/{id}', name: 'app_moniteurs_update', methods: ['POST'])]
    public function update(int $id, Request $request, MONITEURRepository $moniteurRepository, EntityManagerInterface $em): Response
    {
        $moniteur = $moniteurRepository->find($id);
        $moniteur->setActivite((bool) $request->request->get('valeur'));
        $em->flush();
        return $this->redirectToRoute('app_moniteurs');
    }
}
