<?php

namespace App\DataFixtures;

use App\Entity\Loc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['en','es'] as $locale) {
            $fn = "data/modo.$locale.md";
            assert(file_exists($fn));
            $content = file_get_contents($fn);
            $x = preg_split('/#/', $content);
            foreach ($x as $idx => $section) {
                if (empty($section)) {
                    continue;
                }
                $lines = explode("\n", $section);
                $title = trim(array_shift($lines));
                $description = trim(join("\n", $lines));
                $data[$idx][$locale] = [
                    'title' => $title,
                    'description' => substr($description, 0, 40),
                ];
            }
            $loc = new Loc()
                ->setLocale($locale)
                ->setLabel($title)
                ->setDescription($description);

            $manager->persist($loc);
        }

        $manager->flush();
    }
}
