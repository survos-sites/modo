<?php

namespace App\DataFixtures;

use App\Entity\Expo;
use App\Entity\Loc;
use App\Entity\Obj;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Reader;
use Psr\Log\LoggerInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private LoggerInterface $logger,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {

        $csv = Reader::createFromPath('data/modo1.csv', 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); //returns the CSV header record

        foreach (['en', 'es'] as $locale) {
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
                    'description' => $description, // substr($description, 0, 40),
                ];
            }
        }
        foreach ($data as $idx => $record) {
            // using DoctrineBehaviors
            $expo = new Expo()
                ->setCode('expo' . $idx);
            $manager->persist($expo);
            foreach ($record as $locale => $values) {
                $expo->translate($locale)->setTitle($values['title']);
                $expo->translate($locale)->setContent($values['description']);
                $expo->mergeNewTranslations();
            }


            // using JsonTranslate
            $loc = new Loc($idx);
            $manager->persist($loc);
            foreach ($record as $locale => $values) {
//                $loc->setLabel($record['es']['title']);
//                $loc->setDescription($record['es']['description']);
                $loc->setLocale('es'); // original locale
                $loc
                    ->getTitle()[$locale] = $values['title'];
                $loc
                    ->getContent()[$locale] = $values['description'];

            }
            $locations[] = $loc;
        }

        //returns all the records as
        $records = $csv->getRecords(); // an Iterator object containing arrays
//        $records = $csv->getRecordsAsObject(MyDTO::class); //an Iterator object containing MyDTO objects
        foreach ($records as $idx => $record) {
            $loc = $locations[array_rand($locations)];
            $obj = new Obj()
                ->setLocale('es')
                ->setCode($record["ID Inventario1"])
                ->setLabel($record["Nombre"])
                ->setInfo($record["Ficha"])
                ->setDescription($record["Descripción Formal"]);
            $loc->addObj($obj);
            $manager->persist($obj);
        }


        $manager->flush();
    }
}
