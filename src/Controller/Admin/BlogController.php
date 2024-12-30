<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/admin/blogs', name: 'admin_blog')]
    public function listeBlogs(BlogRepository $repo): Response
    {
        $blogs = $repo->findBy(['user' => $this->getUser()]);

        return $this->render('admin/Blog/listeBlogs.html.twig', [
            'lesBlogs' => $blogs,
        ]);
    }

    #[Route('/admin/blog/ajout', name: 'admin_blog_ajout', methods: ['GET', 'POST'])]
    public function ajoutBlog(Request $request, EntityManagerInterface $manager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blog->setUser($this->getUser());
            $manager->persist($blog);
            $manager->flush();

            $this->addFlash('success', 'Blog ajouté avec succès.');
            return $this->redirectToRoute('admin_blog');
        }

        return $this->render('admin/blog/formAjoutBlog.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/blog/modif/{id}', name: 'admin_blog_modif', methods: ['GET', 'POST'])]
    public function modifBlog(Blog $blog, Request $request, EntityManagerInterface $manager): Response
    {
        if ($blog->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas modifier ce blog.');
        }

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', 'Blog modifié avec succès.');
            return $this->redirectToRoute('admin_blog');
        }

        return $this->render('admin/blog/formAjoutBlog.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/blog/suppression/{id}', name: 'admin_blog_suppression')]
    public function suppressionBlog(Blog $blog, EntityManagerInterface $manager): Response
    {
        if ($blog->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer ce blog.');
        }

        $manager->remove($blog);
        $manager->flush();

        $this->addFlash('success', 'Blog supprimé avec succès.');
        return $this->redirectToRoute('admin_blog');
    }
}