<?php
namespace App\Controller;

use App\Entity\VEHICULE;
use App\Entity\MODELE;
use App\Form\VehiculeType;
use App\Form\ModeleType;
use App\Repository\VEHICULERepository;
use App\Repository\MODELERepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VehiculeController extends AbstractController
{
    #[Route('/vehicules', name: 'app_vehicules')]
    public function index(
        VEHICULERepository $vehiculeRepository,
        MODELERepository $modeleRepository,
        PaginatorInterface $paginator,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Search vehicules
        $searchVehicule = $request->query->get('search_vehicule', '');
        $queryVehicule = $vehiculeRepository->createQueryBuilder('v')
            ->leftJoin('v.modele_vehic', 'm')
            ->addSelect('m')
            ->where('v.num_immatric LIKE :search')
            ->setParameter('search', '%' . $searchVehicule . '%')
            ->getQuery();
        // Pagination vehicules
        $vehicules = $paginator->paginate(
            $queryVehicule,
            $request->query->getInt('page_vehicule', 1),
            10,
            ['pageParameterName' => 'page_vehicule']
        );

        // Search modeles
        $searchModele = $request->query->get('search_modele', '');
        $queryModele = $modeleRepository->createQueryBuilder('m')
            ->where('m.modele_vehic LIKE :search OR m.marque LIKE :search')
            ->setParameter('search', '%' . $searchModele . '%')
            ->getQuery();
        // Pagination modeles
        $modeles = $paginator->paginate(
            $queryModele,
            $request->query->getInt('page_modele', 1),
            10,
            ['pageParameterName' => 'page_modele']
        );

        // Vehicule form
        $vehicule = new VEHICULE();
        $formVehicule = $this->createForm(VehiculeType::class, $vehicule);
        $formVehicule->handleRequest($request);
        if ($formVehicule->isSubmitted() && $formVehicule->isValid()) {
            $em->persist($vehicule);
            $em->flush();
            return $this->redirectToRoute('app_vehicules');
        }

        // Modele form
        $modele = new MODELE();
        $formModele = $this->createForm(ModeleType::class, $modele);
        $formModele->handleRequest($request);
        if ($formModele->isSubmitted() && $formModele->isValid()) {
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('app_vehicules');
        }

        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehicules,
            'modeles' => $modeles,
            'formVehicule' => $formVehicule,
            'formModele' => $formModele,
        ]);
    }

    #[Route('/vehicules/update/{id}', name: 'app_vehicules_update', methods: ['POST'])]
    public function update(string $id, Request $request, VEHICULERepository $vehiculeRepository, EntityManagerInterface $em): Response
    {
        $vehicule = $vehiculeRepository->find($id);
        $vehicule->setEtat((bool) $request->request->get('valeur'));
        $em->flush();
        return $this->redirectToRoute('app_vehicules');
    }
}