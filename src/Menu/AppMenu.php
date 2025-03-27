<?php

namespace App\Menu;

use Survos\FwBundle\Event\KnpMenuEvent;
use Survos\FwBundle\Menu\KnpMenuHelperInterface;
use Survos\FwBundle\Menu\KnpMenuHelperTrait;
use Survos\FwBundle\Menu\MenuService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use function Symfony\Component\String\u;

// events are
/*
// #[AsEventListener(event: KnpMenuEvent::NAVBAR_MENU2)]
#[AsEventListener(event: KnpMenuEvent::SIDEBAR_MENU, method: 'sidebarMenu')]
#[AsEventListener(event: KnpMenuEvent::PAGE_MENU, method: 'pageMenu')]
#[AsEventListener(event: KnpMenuEvent::FOOTER_MENU, method: 'footerMenu')]
#[AsEventListener(event: KnpMenuEvent::AUTH_MENU, method: 'appAuthMenu')]
*/

final class AppMenu implements KnpMenuHelperInterface
{
//    use KnpMenuHelperTrait;
//
    public function __construct(
//        #[Autowire('%kernel.environment%')] protected string $env,
//        private ?MenuService                                 $menuService = null,
//        private ?Security                                    $security = null,
//        private ?AuthorizationCheckerInterface               $authorizationChecker = null
    )
    {
    }
//
//    public function appAuthMenu(KnpMenuEvent $event): void
//    {
//        $menu = $event->getMenu();
//        $this->menuService->addAuthMenu($menu);
//    }
//
//    #[AsEventListener(event: KnpMenuEvent::MOBILE_UNLINKED_MENU)]
//    public function templateMenu(KnpMenuEvent $event): void
//    {
//        $menu = $event->getMenu();
//        $this->add($menu, route: 'app_page', rp: ['page' => 'obra']);
//    }
//
//    #[AsEventListener(event: KnpMenuEvent::MOBILE_PAGE_MENU)]
//    public function pageMenu(KnpMenuEvent $event): void
//    {
//        $menu = $event->getMenu();
//        foreach ([
////                     'about' => 'tabler:info-circle',
//                     'refresh' => 'tabler:refresh',
//                     'settings' => 'tabler:settings',
//                 ] as $route => $icon) {
//            $this->add($menu, id: $route, route: 'app_page',
//                rp: ['page' => $route, 'type' => 'page'], icon: $icon,
//                label: u($route)->title()->toString());
//        }
//    }
//
//    #[AsEventListener(event: KnpMenuEvent::MOBILE_TAB_MENU)]
//    public function tabMenu(KnpMenuEvent $event): void
//    {
//        $menu = $event->getMenu();
//        foreach ([
//                     'info' => 'tabler:info-circle',
//                     'locations' => 'tabler:location-search',
////                     'artists' => 'tabler:users',
//                 ] as $route => $icon) {
//            $this->add($menu, id: $route, route: 'app_page',
//                rp: ['page' => $route, 'type' => 'tab'], icon: $icon,
//                label: u($route)->title()->toString());
//        }
//
////        $this->add($menu, id: 'map',route: "app_map", label: 'Map', icon: 'tabler:list');
////        $this->add($menu, id: 'about',route: "app_about", label: 'About', icon: );
//
//
//    }
}
