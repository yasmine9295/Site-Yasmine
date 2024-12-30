<?php

namespace App\Controller\Blogueur;

use App\Entity\Blog;
use App\Form\ArticleType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Blogueur\BlogController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter; 

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'admin_blog' , methods:"GET")]
    public function listeBlogs(BlogRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $blogs = $paginator->paginate(
            $repo->listeBlogsCompletePaginee(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('admin/Blog/listeBlogs.html.twig', [
            'lesBlogs' => $blogs
        ]);
    }

    #[Route('/blog/{id}', name: 'ficheBlog' , methods:"GET")]

    public function ficheblog(Blog $blog)
    {
        return $this->render('blog/ficheBlog.html.twig', [
            'leblog' => $blog
        ]);
    }

    #[Route('/blog/ajout', name: 'blog_ajout' , methods:["GET","POST"])]
    #[Route('/blog/modif/{id}', name: 'blog_modif' , methods:["GET","POST"])]
    public function ajoutModifBlog(Blog $blog = null, Request $request, EntityManagerInterface $manager)
    {
        if($blog==null){
            $blog=new Blog();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }

        $form=$this->createForm(ArticleType::class,$blog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($blog);
            $manager->flush();
            $this->addFlash("success", "L'article a bien été $mode");
            return $this->redirectToRoute('admin_blogs');
        }
        return $this->render('admin/Blog/formAjoutModifBlog.html.twig', [
            'formBlog' => $form->createView()
        ]);
    }
}
