<?php

namespace App\Controller\Admin;




use App\Entity\Mannequins;

use App\Form\MannequinType;
use App\Repository\MannequinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\DefileController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MannequinsController extends AbstractController
{
    #[Route('/mannequins', name: 'admin_mannequins' , methods:"GET")]

    public function listeMannequins(MannequinsRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $mannequins=$paginator->paginate(
            $repo->listeMannequinsCompletePaginee(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('admin/Mannequins/listeMannequins.html.twig', [
            'lesmannequins' => $mannequins
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
            $this->addFlash("success", "l'mannequin a bien été $mannequin");
            return $this->redirectToRoute('admin_mannequin');
        }
        return $this->render('admin/mannequin/formAjoutModifMannequin.html.twig', [
            'formMannequin' => $form->createView()
        ]);
    }

    
    #[Route('/admin/mannequin/suppression/{id}', name: 'admin_mannequin_suppression' , methods:["GET"])]

    public function suppressionMannequin(Mannequin $defile, EntityManagerInterface $manager)
    {
        $nbAlbums=$mannequin->getAlbums()->count();
        if($nbAlbums > 0)
        {
            $this->addFlash("danger","Vous ne pouvez pas supprimer cet mannequin car $nbAlbums album(s) y sont associés");
        }else{
            $manager->remove($mannequin);
            $manager->flush();
            $this->addFlash("success","le mannequin a bien été supprimé");
        }
        return $this->redirectToRoute('admin_mannequin');
    }

}