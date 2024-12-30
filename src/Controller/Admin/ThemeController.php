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
        $theme = new Theme(); // Créer une nouvelle instance de l'entité Theme
        $form = $this->createForm(ThemeType::class, $theme); // Créer le formulaire pour Theme

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder le thème dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();

            // Rediriger vers la liste des thèmes ou une autre page après l'ajout
            return $this->redirectToRoute('admin_theme_liste');
        }

        return $this->render('theme/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}