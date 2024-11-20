<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageBlogController extends AbstractController
{
    #[Route('/image/blog', name: 'app_image_blog')]
    public function index(): Response
    {
        return $this->render('image_blog/index.html.twig', [
            'controller_name' => 'ImageBlogController',
        ]);
    }
}
