<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageVetementController extends AbstractController
{
    #[Route('/image/vetement', name: 'app_image_vetement')]
    public function index(): Response
    {
        return $this->render('image_vetement/index.html.twig', [
            'controller_name' => 'ImageVetementController',
        ]);
    }
}
