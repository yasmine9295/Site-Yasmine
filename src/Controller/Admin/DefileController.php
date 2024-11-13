<?php

namespace App\Controller\Admin;



use App\Entity\Defile;
use App\Form\DefileType;
use App\Repository\DefileRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\DefileController;
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
            $this->addFlash("success", "l'defile a bien été $mode");
            return $this->redirectToRoute('admin_defiles');
        }
        return $this->render('admin/defile/formAjoutModifDefile.html.twig', [
            'formDefile' => $form->createView()
        ]);
    }

    #[Route('/admin/defile/suppression/{id}', name: 'admin_defile_suppression' , methods:["GET"])]

    public function suppressionDefile(Defile $defile, EntityManagerInterface $manager)
    {
        $nbAlbums=$defile->getAlbums()->count();
        if($nbAlbums > 0)
        {
            $this->addFlash("danger","Vous ne pouvez pas supprimer cet defile car $nbAlbums album(s) y sont associés");
        }else{
            $manager->remove($defile);
            $manager->flush();
            $this->addFlash("success","le defile a bien été supprimé");
        }
        return $this->redirectToRoute('admin_defiles');
    }
}
