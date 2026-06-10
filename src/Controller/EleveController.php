<?php
namespace App\Controller;

use App\Repository\ELEVERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EleveController extends AbstractController
{
    #[Route('/eleves', name: 'app_eleves')]
    public function index(ELEVERepository $eleveRepository): Response
    {
        $eleves = $eleveRepository->findAll();

        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleves,
        ]);
    }
}