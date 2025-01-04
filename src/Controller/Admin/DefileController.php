<?php

namespace App\Controller\Admin;



use App\Entity\Defile;
use App\Form\DefileType;
use App\Repository\DefileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefileController extends AbstractController
{
    #[Route('/admin/defiles', name: 'admin_defiles' , methods:"GET")]

    public function listeDefiles(DefileRepository $repo , PaginatorInterface $paginator, Request $request)
    {
        $defiles= $paginator->paginate(
        $repo->listeDefilesCompletePaginee(),
        $request->query->getInt('page', 1),
        9
        );
        return $this->render('admin/defile/listeDefiles.html.twig', [
            'lesDefiles' => $defiles
        ]);
    }

    #[Route('/admin/defile/ajout', name: 'admin_defile_ajout' , methods:["GET","POST"])]
    #[Route('/admin/defile/modif/{id}', name: 'admin_defile_modif' , methods:["GET","POST"])]

    public function ajoutModifDefile(Defile $defile=null, Request $request, EntityManagerInterface $manager)
    {
        if($defile==null){
            $defile=new Defile();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }

        $form=$this->createForm(DefileType::class,$defile);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($defile);
            $manager->flush();
            $this->addFlash("success", "le defile a bien été $defile");
            return $this->redirectToRoute('admin_defiles');
        }
        return $this->render('admin/defile/formAjoutModifDefile.html.twig', [
            'formDefile' => $form->createView()
        ]);
    }

    #[Route('/admin/defile/suppression/{id}', name: 'admin_defile_suppression', methods: ["GET"])]
    public function suppressionDefile(Defile $defile, EntityManagerInterface $manager)
    {
            $manager->remove($defile);
            $manager->flush();
            $this->addFlash("success","le defile a bien été supprimé");
        
        return $this->redirectToRoute('admin_defiles');
    }

    public function index(Request $request, DefileRepository $DefileRepository, PaginatorInterface $paginator): Response
    {
        $search = $request->query->get('search');

        $query = $search 
            ? $DefileRepository->findBySearchQuery($search) 
            : $DefileRepository->findAllQuery();
        $lesDefiles = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
            9 
        );

        return $this->render('defile/listeDefile.html.twig', [
            'lesDefiles' => $lesDefiles,
        ]);
    }
}
    

