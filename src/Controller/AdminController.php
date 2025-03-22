<?php

namespace App\Controller;

use App\Entity\Loc;
use App\Repository\LocRepository;
use App\Repository\ObjRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
final class AdminController extends AbstractController
{
    public function __construct(
        private LocRepository $locRepository,
        private ObjRepository $objRepository,
        private EntityManagerInterface $entityManager,
    )
    {

    }
    #[Route('/', name: 'index', methods: ['GET'])]
    #[Template('admin/index.html.twig')]
    public function index(Request $request,  LocRepository $locRepository): Response|array
    {
        return [
            'locs' => $locRepository->findAll(),
        ];

    }

    #[Route('/browse/{core}/{_locale}', name: 'browse', methods: ['GET'])]
    public function browse(Request $request,  string $core, LocRepository $locRepository): Response
    {
        $repo = $this->getRepo($core);
        return $this->render('admin/browse.html.twig', [
            'core' => $core,
            'items' => $repo->findBy(['locale' => $request->getLocale()]),
        ]);
    }

    private function getRepo(string $core): ServiceEntityRepositoryInterface
    {
        return match($core) {
            'loc' => $this->locRepository,
            'obj' => $this->objRepository,
        };
    }

    #[Route('/{_locale}/detail/{core}/{id}', name: 'detail', methods: ['GET'])]
    #[Template('admin/detail.html.twig')]
    public function detail(Request $request,  string $core, string $id): array
    {
        return [
            'item' => $this->getRepo($core)->find($id),
        ];
    }

}
