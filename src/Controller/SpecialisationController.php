<?php

namespace App\Controller;

use App\Repository\SpecialisationRepository;
use App\Repository\MannequinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialisationController extends AbstractController
{
    #[Route(path: '/specialisation', name: 'specialisations')]
    public function index(SpecialisationRepository $specialisationRepository, MannequinsRepository $mannequinRepository): Response
    {
        // Récupérer toutes les spécialisations
        $specialisations = $specialisationRepository->findAll();

        // Créer un tableau pour stocker les mannequins associés à chaque spécialisation
        $specialisationMannequins = [];

        foreach ($specialisations as $specialisation) {
            // Récupérer les mannequins associés à chaque spécialisation
            $mannequins = $mannequinRepository->findBy(['specialisation' => $specialisation]);

            // Ajouter à notre tableau avec le nom de la spécialisation et les mannequins associés
            $specialisationMannequins[] = [
                'specialisation' => $specialisation,
                'mannequins' => $mannequins,
                'count' => count($mannequins),  // Nombre de mannequins
            ];
        }

        // Passer ces informations à la vue
        return $this->render('specialisation/index.html.twig', [
            'specialisationMannequins' => $specialisationMannequins,
        ]);
    }
}
