<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/admin/blog', name: 'admin_blog' , methods:"GET")]

    public function listeBlogs(BlogRepository $repo , PaginatorInterface $paginator, Request $request)
    {
        $blogs= $paginator->paginate(
        $repo->listeBlogsCompletePaginee(),
        $request->query->getInt('page', 1),
        9
        );
        return $this->render('admin/blog/listeBlogs.html.twig', [
            'lesBlogs' => $blogs
        ]);
    }

    #[Route('/admin/blog/ajout', name: 'admin_blog_ajout' , methods:["GET","POST"])]
    #[Route('/admin/blog/modif/{id}', name: 'admin_blog_modif' , methods:["GET","POST"])]

    public function ajoutModifBlog(Blog $blog=null, Request $request, EntityManagerInterface $manager)
    {
        if($blog==null){
            $blog=new Blog();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }

        $form=$this->createForm(BlogType::class,$blog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($blog);
            $manager->flush();
            $this->addFlash("success", "le blog a bien été $blog");
            return $this->redirectToRoute('admin_blogs');
        }
        return $this->render('admin/blog/formAjoutModifBlog.html.twig', [
            'formBlog' => $form->createView()
        ]);
    }

    #[Route('/admin/blog/suppression/{id}', name: 'admin_blog_suppression', methods: ["GET"])]
    public function suppressionBlog(Blog $blog, EntityManagerInterface $manager)
    {
            $manager->remove($blog);
            $manager->flush();
            $this->addFlash("success","le blog a bien été supprimé");
        
        return $this->redirectToRoute('admin_blogs');
    }
}
    

