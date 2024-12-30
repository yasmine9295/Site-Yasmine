<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Blog;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/new/{blog}', name: 'comment_new', methods: ['POST'])]
    public function new(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setAuthor($this->getUser());
            $comment->setBlog($blog);

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('blog_index');
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
