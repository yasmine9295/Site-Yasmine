<?php


namespace App\Controller\Admin;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    #[Route('/admin/theme/ajouter', name: 'admin_theme_ajouter')]
    public function ajouter(Request $request, ThemeRepository $themeRepository): Response
    {
        $theme = new Theme(); 
        $form = $this->createForm(ThemeType::class, $theme); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_theme_liste');
        }

        return $this->render('theme/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
