<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\OffreDeStage;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffreDeStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Utilisation de Faker pour générer des données aléatoires
        $faker = Faker::create();

        // Nombre d'offres de stage à créer
        $numberOfOffers = 10;

        // Boucle pour créer les offres de stage
        for ($i = 0; $i < $numberOfOffers; $i++) {
            // Récupération aléatoire d'un département existant
            $departement = Departement::inRandomOrder()->first();

            // Création d'une nouvelle offre de stage avec des données aléatoires
            OffreDeStage::create([
                'titre' => $faker->sentence,
                'description' => $faker->paragraph,
                'date_publication' => $faker->dateTimeBetween('-1 year', 'now'),
                'date_fin' => $faker->dateTimeBetween('now', '+1 year'),
                'departement_id' => $departement->departement_id,
            ]);
        }
    }
}
