<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etablissement;

class EtablissementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $csv = fopen('./data/fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre.csv', 'r');

        $i=0;
        while(!feof($csv)){
            $ligne = fgetcsv($csv, 0, ";");
            if($i > 0) {
                $etablissement = new Etablissement();
                $etablissement -> setNom($ligne[1]);
                $etablissement -> setNature($ligne[2]);
                $etablissement -> setSecteur($ligne[4]);
                $etablissement -> setLongitude((float)$ligne[15]);
                $etablissement -> setLatitude((float)$ligne[14]);
                $etablissement -> setAdresse($ligne[5]);
                $etablissement -> setDepartement($ligne[22]);
                $etablissement -> setCommune($ligne[10]);
                $etablissement -> setRegion($ligne[27]);
                $etablissement -> setAcademie($ligne[28]);
                $etablissement -> setDateOuverture($ligne[34]);
                $manager->persist($etablissement);
                if($i%100==0){
                    $manager->flush();
                }
            }
            $i = $i + 1;
        }
        $manager->flush();
    }
}
