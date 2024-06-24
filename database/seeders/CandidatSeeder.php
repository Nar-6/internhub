<?php
// database/seeders/CandidatSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidat;
use Faker\Factory as Faker;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            Candidat::create([
                'age' => $faker->numberBetween(18, 60),
                'cv' => 'cvs/' . $faker->uuid . '.pdf', // Assuming you store CVs in a 'cvs' directory
                'lettre_de_motivation' => 'lettres/' . $faker->uuid . '.pdf', // Assuming you store letters in a 'lettres' directory
                'retenu' => $faker->boolean,
                'sexe' => $faker->randomElement(['M', 'F']),
                'user_id' => $i+1, // Make sure these user_ids exist in your users table
            ]);
        }
    }

    public function down()
    {
        // Supprimer les données insérées
        Candidat::truncate(); // Supprime tous les enregistrements de la table 'users'
    }
}
