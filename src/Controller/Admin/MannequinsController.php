<?php

namespace App\Controller\Admin;




use App\Entity\Mannequins;

use App\Form\MannequinType;
use App\Repository\DefileRepository;
use App\Repository\MannequinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\DefileController;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\SpecialisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MannequinsController extends AbstractController
{
    #[Route('/mannequins', name: 'admin_mannequins' , methods:"GET")]

    public function listeMannequins(MannequinsRepository $repo,SpecialisationRepository $specialisationRepository, PaginatorInterface $paginator, Request $request)
    {
        
         
        // Pagination des spécialisations
        $specialisations = $paginator->paginate(
            $specialisationRepository->findAll(), // Utiliser findAll pour récupérer toutes les spécialisations
            $request->query->getInt('page', 1),
            9
        );
        $nom=$request->query->get('search');
        $specialisationId = $request->query->get('specialisation');


        $mannequins=$paginator->paginate(
            $repo->listeMannequinsCompletePaginee($nom, $specialisationId),
            $request->query->getInt('page', 1),
            9
        );
        // dd($mannequins);
        return $this->render('admin/Mannequins/listeMannequins.html.twig', [
            'lesmannequins' => $mannequins,
            'specialisations' => $specialisations
        ]);
    }



    #[Route('/mannequin/{id}', name: 'ficheMannequin' , methods:"GET")]

    public function ficheMannequin(Mannequins $mannequin)
    {
        return $this->render('Mannequin/ficheMannequin.html.twig', [
            'leMannequin' => $mannequin
        ]);
    }

    #[Route('/admin/mannequin/ajout', name: 'admin_mannequin_ajout' , methods:["GET","POST"])]
    #[Route('/admin/mannequin/modif/{id}', name: 'admin_mannequin_modif' , methods:["GET","POST"])]

    public function ajoutModifMannequin(Mannequins $mannequin=null, Request $request, EntityManagerInterface $manager)
    {
        if($mannequin==null){
            $mannequin=new Mannequins();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }

        $form=$this->createForm(MannequinType::class,$mannequin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($mannequin);
            $manager->flush();
            $this->addFlash("dark", "Le mannequin " . $mannequin->getNom() . " " . $mannequin->getPrenom() . " a bien été $mode.");
            return $this->redirectToRoute('admin_mannequins');
        }
        return $this->render('admin/Mannequins/formAjoutModifMannequin.html.twig', [
            'formMannequin' => $form->createView()
        ]);
    }

    
    #[Route('/admin/mannequin/suppression/{id}', name: 'admin_mannequin_suppression' , methods:["GET"])]
    public function suppressionMannequin(Mannequins $mannequin, EntityManagerInterface $manager)
    {
            $manager->remove($mannequin);
            $manager->flush();
            $this->addFlash("success","Le mannequin a bien été supprimé");
        
        return $this->redirectToRoute('admin_mannequins');
    }

    public function index(Request $request, MannequinsRepository $mannequinRepository, DefileRepository $defileRepository): Response
    {
    
        $defileSearch = $request->query->get('defiles', '');
        $defiles = $defileRepository->findAll();

        if ($defileSearch) {
            $mannequins = $mannequinRepository->findByDefile($defileSearch);
        } else {
            $mannequins = $mannequinRepository->findAll();
        }
    
        return $this->render('mannequin/index.html.twig', [
            'mannequins' => $mannequins,
            'defiles' => $defiles,  // Liste des défilés pour la liste déroulante
            'defilesSearch' => $defileSearch,  // Terme de recherche
        ]);
    }
}