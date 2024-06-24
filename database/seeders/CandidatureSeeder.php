<?php

namespace Database\Seeders;

use App\Models\Candidat;
use App\Models\Candidature;
use App\Models\OffreDeStage;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Utilisation de Faker pour générer des données aléatoires
        $faker = Faker::create();

        // Nombre de candidatures à créer
        $numberOfCandidatures = 20;

        // Boucle pour créer les candidatures
        for ($i = 0; $i < $numberOfCandidatures; $i++) {
            // Récupération aléatoire d'un candidat existant
            $candidat = Candidat::inRandomOrder()->first();

            // Récupération aléatoire d'une offre de stage existante
            $offreDeStage = OffreDeStage::inRandomOrder()->first();

            // Création d'une nouvelle candidature avec des données aléatoires
            Candidature::create([
                'date_soumission' => $faker->dateTimeBetween('-1 year', 'now'),
                'statut' => $faker->randomElement(['soumis', 'en attente', 'rejeté', 'accepté']),
                'candidat_id' => $candidat->candidat_id,
                'offre_de_stage_id' => $offreDeStage->offre_de_stage_id,
            ]);
        }
    }
}
