<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'admin_blog' , methods:"GET")]

    public function listeBlogs(BlogRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $blogs=$paginator->paginate(
            $repo->listeBlogsCompletePaginee(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('blog/listeBlogs.html.twig', [
            'lesblogs' => $blogs
        ]);
    }
        
    #[Route('/blog/{id}', name: 'formAjoutMofifblog' , methods:"GET")]

    public function ficheblog(Blog $blog)
    {
        return $this->render('blog/formAjoutMofifBlog.html.twig', [
            'leblog' => $blog
        ]);
    }
}
