<?php

namespace Database\Seeders;

use App\Models\Batiment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BatimentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Batiment::truncate();

        $faker = Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5000; $i++) {
            Batiment::create([
                "nom_methode_dpe" => $faker->randomElement([
                    '3CL',
                    '3CL - DPE',
                    '3CL - 2012',
                    'DPE VIERGE',
                    'FACTURE',
                    'FACTURE - DPE',
                    'Th-C-E',
                ]),
                "version_methode_dpe" => $faker->randomElement([
                    '1.3',
                    '2012',
                    'RT2005',
                    'v15c',
                ]),
                "date_etablissement_dpe" => $faker->date(),
                "consommation_energie" => $faker->randomFloat(4, 0, 1700),
                "estimation_ges" => $faker->randomFloat(4, 0, 200),
                "annee_construction" => $faker->numberBetween(1800, 2020),
                "surface_thermique_lot" => $faker->randomFloat(4, 0, 300),
                'tr001_modele_dpe_type_libelle' => $faker->randomElement(["Vente", "Location", "Neuf"]),
                'tr002_type_batiment_description' => $faker->randomElement(["Maison Individuelle", "Logement", "Bâtiment collectif à usage principal d'habitation"]),
                "code_insee_commune_actualise" => $faker->numberBetween(1, 99999),
                "tv016_departement_code" => $faker->numberBetween(1, 99),
                "geo_score" => $faker->randomFloat(4, 0, 1),
                'geo_adresse' => $faker->streetAddress(),
                'latitude' => $faker->randomFloat(4, 40, 52),
                'longitude' => $faker->randomFloat(4, -5, 10),
                'classe_consommation_energie' => $faker->randomElement(["A", "B", "C", "D", "E", "F", "G", "N"]),
                'classe_estimation_ges' => $faker->randomElement(["A", "B", "C", "D", "E", "F", "G", "N"]),
            ]);
        }
    }
}
