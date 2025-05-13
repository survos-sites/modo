<?php

namespace App\Tests\Crawl;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use Survos\CrawlerBundle\Tests\BaseVisitLinksTest;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrawlAsVisitorTest extends BaseVisitLinksTest
{
	#[TestDox('/$method $url ($route)')]
	#[TestWith(['', '/admin/reset-password', 200])]
	#[TestWith(['', '/admin/reset-password/check-email', 200])]
	#[TestWith(['', '/admin/reset-password/reset', 200])]
	#[TestWith(['', '/admin/login', 200])]
	#[TestWith(['', '/admin/logout', 200])]
	#[TestWith(['', '/es/admin/easy-admin-user', 200])]
	#[TestWith(['', '/es/admin/easy-admin-user/new', 200])]
	#[TestWith(['', '/es/admin/easy-admin-user/batch-delete', 200])]
	#[TestWith(['', '/es/admin/easy-admin-user/autocomplete', 200])]
	#[TestWith(['', '/es/admin/easy-admin-user/render-filters', 200])]
	#[TestWith(['', '/es/admin/expo', 200])]
	#[TestWith(['', '/es/admin/expo/new', 200])]
	#[TestWith(['', '/es/admin/expo/batch-delete', 200])]
	#[TestWith(['', '/es/admin/expo/autocomplete', 200])]
	#[TestWith(['', '/es/admin/expo/render-filters', 200])]
	#[TestWith(['', '/es/admin/obj', 200])]
	#[TestWith(['', '/es/admin/obj/new', 200])]
	#[TestWith(['', '/es/admin/obj/batch-delete', 200])]
	#[TestWith(['', '/es/admin/obj/autocomplete', 200])]
	#[TestWith(['', '/es/admin/obj/render-filters', 200])]
	#[TestWith(['', '/js/routing', 200])]
	#[TestWith(['', '/auth/profile', 200])]
	#[TestWith(['', '/auth/providers', 200])]
	#[TestWith(['', '/crawler/crawlerdata', 200])]
	#[TestWith(['', '/admin', 200])]
	#[TestWith(['', '/app', 200])]
	#[TestWith(['', '/admin/', 200])]
	#[TestWith(['', '/', 200])]
	#[TestWith(['', '/register', 200])]
	#[TestWith(['', '/login', 200])]
	public function testRoute(string $username, string $url, string|int|null $expected): void
	{
		parent::loginAsUserAndVisit($username, $url, (int)$expected);
	}
}
