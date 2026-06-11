<?php
namespace App\Controller;

use App\Entity\LECON;
use App\Entity\CALENDRIER;
use App\Form\LeconType;
use App\Repository\LECONRepository;
use App\Repository\CALENDRIERRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LeconController extends AbstractController
{
    #[Route('/lecons', name: 'app_lecons')]
    public function index(
        LECONRepository $leconRepository,
        CALENDRIERRepository $calendrierRepository,
        PaginatorInterface $paginator,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $search = $request->query->get('search', '');

        $query = $leconRepository->createQueryBuilder('l')
            ->join('l.lecon_eleve_id', 'e')
            ->join('l.lecon_moniteur_id', 'm')
            ->join('l.lecon_modele_vehic', 'v')
            ->where('e.nom_eleve LIKE :search OR m.nom_moniteur LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery();

        $lecons = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        $lecon = new LECON();
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {
            dd($lecon);
        }

        return $this->render('lecon/index.html.twig', [
            'lecons' => $lecons,
            'form' => $form,
        ]);
    }
}