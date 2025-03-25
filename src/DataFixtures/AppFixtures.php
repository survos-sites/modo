<?php

namespace App\DataFixtures;

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

//returns all the records as
        $records = $csv->getRecords(); // an Iterator object containing arrays
//        $records = $csv->getRecordsAsObject(MyDTO::class); //an Iterator object containing MyDTO objects
        foreach ($records as $idx => $record) {
            $obj = new Obj()
                ->setLocale($idx % 2 ? 'es' : 'en')
                ->setCode($record["ID Inventario1"])
                ->setLabel($record["Nombre"])
                ->setInfo($record["Ficha"])
                ->setDescription($record["Descripción Formal"])
            ;
            $manager->persist($obj);
        }

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
                    'description' => substr($description, 0, 40),
                ];
                $loc = new Loc()
                    ->setLocale($locale)
                    ->setLabel($title)
                    ->setDescription($description);
                $manager->persist($loc);
                $this->logger->info("Loading data from {$title}", $data[$idx][$locale]);
            }


        }



        $manager->flush();
    }
}
