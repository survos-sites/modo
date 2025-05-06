<?php

namespace App\Controller;

use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    public function __construct(
        private MetaTagsManagerInterface $metaTags
    )
    {
        $this->metaTags->setTitle("EL MODO");

    }
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('app/home.html.twig', [
            'url' => 'https://vt.survos.com/es/modo',
        ]);
    }
}
