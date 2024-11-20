<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageMannequinController extends AbstractController
{
    #[Route('/image/mannequin', name: 'app_image_mannequin')]
    public function index(): Response
    {
        return $this->render('image_mannequin/index.html.twig', [
            'controller_name' => 'ImageMannequinController',
        ]);
    }
}
