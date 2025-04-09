<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::createOne([
            'code' => 'superadmin',
            'email' => 'superadmin@example.com',
            'plainPassword' => 'adminpass',
            'roles' => ['ROLE_SUPER_ADMIN'],
        ]);

        foreach (['tacman@gmail.com', 'yarenivillada@gmail.com'] as $email) {
            UserFactory::createOne([
                'code' => str_replace('@gmail.com', '', $email),
                'email' => $email,
                'plainPassword' => 'batsi',
                'roles' => ['ROLE_ADMIN'],
            ]);
        }

        UserFactory::createOne([
            'code' => 'admin',
            'email' => 'admin@test.com',
            'plainPassword' => 'admin',
            'roles' => ['ROLE_ADMIN'],
        ]);

        $manager->flush();
    }
}
