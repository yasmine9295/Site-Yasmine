<?php

namespace App\Controller;

use App\Entity\Mannequins;
use App\Controller\MannequinsController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MannequinsController extends AbstractController
{
    #[Route('/mannequins', name: 'admin_mannequins' , methods:"GET")]

    public function listeMannequins(MannequinsController $repo, PaginatorInterface $paginator, Request $request)
    {
        $mannequins=$paginator->paginate(
            $repo->listeMannequinsCompletePaginee(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('mannequins/listeMannequins.html.twig', [
            'lesmannequins' => $mannequins
        ]);
    }
        
    #[Route('/mannequin/{id}', name: 'ficheMannequin' , methods:"GET")]

    public function ficheMannequin(Mannequins $mannequin)
    {
        return $this->render('mannequin/ficheMannequin.html.twig', [
            'leMannequin' => $mannequin
        ]);
    }
}