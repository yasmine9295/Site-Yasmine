<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Controller\BlogController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blogs', name: 'admin_blogs' , methods:"GET")]

    public function listeblogs(blogsController $repo, PaginatorInterface $paginator, Request $request)
    {
        $blogs=$paginator->paginate(
            $repo->listeblogsCompletePaginee(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('blogs/listeblogs.html.twig', [
            'lesblogs' => $blogs
        ]);
    }
        
    #[Route('/blog/{id}', name: 'ficheblog' , methods:"GET")]

    public function ficheblog(Blog $blog)
    {
        return $this->render('blog/ficheblog.html.twig', [
            'leblog' => $blog
        ]);
    }
}
