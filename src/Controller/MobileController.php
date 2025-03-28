<?php

namespace App\Controller;

use App\Repository\LocRepository;
use Knp\Menu\FactoryInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Attribute\Route;

final class MobileController extends AbstractController
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
    )
    {

    }

    #[Route('/pages/{page}', name: 'app_page', priority: 400)]
    public function page(string $page): Response
    {
        return $this->render("pages/$page.html.twig", [

        ]);
    }

//    #[Route('/', name: '_browse', options: ['expose' => true], methods: ['GET'])]
//    public function landing(Request $request): Response
//    {
//        dd("@todo: list of configs");
//    }

    #[Route('/', name: 'app_index', options: ['expose' => true], methods: ['GET'])]
    #[Template('app/index.html.twig')]
    public function mobile(Request $request, string $configCode='modo'): Response|array
    {
        return [];

        $templates = [];
        // iterate through the page and tab routes to create templates, which will be rendered in the main page.
        $menu = $this->factory->createItem($options['name'] ?? KnpMenuEvent::class);
        foreach ([KnpMenuEvent::MOBILE_TAB_MENU  => 'tab',
//                     KnpMenuEvent::MOBILE_PAGE_MENU => 'page',
//                     KnpMenuEvent::MOBILE_UNLINKED_MENU => 'page',
                 ] as $eventName=>$type) {
            $options = [];
            $options = (new OptionsResolver())
                ->setDefaults([

                ])
                ->resolve($options);
            $this->eventDispatcher->dispatch(new KnpMenuEvent($menu, $this->factory, $options), $eventName);
            foreach ($menu->getChildren() as $route=>$child) {
                    $template = "pages/$route.html.twig";
                    $params = [
                        'type' => $type,
                        'route' => $route,
                        'template' => $template,
                        'debug' => $request->get('debug', false),
                        'config' => $this->fwService->getConfigs()[strtolower($configCode)],
                    ];
//                    $templates[$route]  = $this->twig->render($template, $params);
                    $templates[$route] = $this->renderView($template, $params);
                try {
                } catch (\Exception $e) {
                    dd($route, $template, $e->getMessage(), $e);
                }
            }
        }
        $config = $this->fwService->getConfigs()['modo'];
//        dd($templates);
        return $this->render('@SurvosFw/start.html.twig', [
            'templates' => $templates,
            'config' => $config,
            'playNow' => $request->get('playNow', true),
            'config' => $this->fwService->getConfigs()[strtolower($configCode)],
        ]);
    }
}
