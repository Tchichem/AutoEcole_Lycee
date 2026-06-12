<?php
namespace App\Controller;

use App\Repository\ELEVERepository;
use App\Repository\LECONRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StatistiqueController extends AbstractController
{
    #[Route('/statistiques', name: 'app_statistiques')]
    public function index(ELEVERepository $eleveRepository, LECONRepository $leconRepository): Response
    {
        $annee = (int) date('Y');
        $debut = new \DateTime($annee . '-01-01');
        $fin = new \DateTime($annee . '-12-31');

        $elevesCode = $eleveRepository->createQueryBuilder('e')
            ->select('COUNT(e.id_eleve)')
            ->where('e.code = true')
            ->andWhere('e.date_inscription BETWEEN :debut AND :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->getQuery()
            ->getSingleScalarResult();

        $elevesConduite = $eleveRepository->createQueryBuilder('e')
            ->select('COUNT(e.id_eleve)')
            ->where('e.conduite = true')
            ->andWhere('e.date_inscription BETWEEN :debut AND :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->getQuery()
            ->getSingleScalarResult();

        $elevesPermis = $eleveRepository->createQueryBuilder('e')
            ->select('COUNT(e.id_eleve)')
            ->where('e.code = true')
            ->andWhere('e.conduite = true')
            ->andWhere('e.date_inscription BETWEEN :debut AND :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->getQuery()
            ->getSingleScalarResult();

        $elevesEnDifficulte = $leconRepository->createQueryBuilder('l')
            ->select('e.id_eleve, e.nom_eleve, e.prenom_eleve, e.code, e.conduite, COUNT(l.id) as nb_lecons')
            ->join('l.lecon_eleve_id', 'e')
            ->where('e.code = false OR e.conduite = false')
            ->andWhere('e.date_inscription BETWEEN :debut AND :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->groupBy('e.id_eleve, e.nom_eleve, e.prenom_eleve, e.code, e.conduite')
            ->having('COUNT(l.id) > 3')
            ->orderBy('nb_lecons', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('statistique/index.html.twig', [
            'annee' => $annee,
            'elevesCode' => $elevesCode,
            'elevesConduite' => $elevesConduite,
            'elevesPermis' => $elevesPermis,
            'elevesEnDifficulte' => $elevesEnDifficulte,
        ]);
    }
}