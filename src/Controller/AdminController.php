<?php

namespace App\Controller;

use App\Entity\Loc;
use App\Repository\LocRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
final class AdminController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    #[Template('admin/index.html.twig')]
    public function index(Request $request,  LocRepository $locRepository): Response|array
    {
        return [
            'locs' => $locRepository->findAll(),
        ];

    }

    #[Route('/browse/{_locale}', name: 'browse', methods: ['GET'])]
    public function browse(Request $request,  LocRepository $locRepository): Response
    {

        return $this->render('admin/browse.html.twig', [
            'locs' => $locRepository->findBy(['locale' => $request->getLocale()]),
        ]);
    }

    #[Route('/{_locale}/detail/{locId}', name: 'detail', methods: ['GET'])]
    #[Template('admin/detail.html.twig')]
    public function detail(Request $request,  Loc $loc): array
    {
        return [
            'loc' => $loc,
        ];
    }

}
