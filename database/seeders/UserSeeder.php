<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

       
            $user = User::create([
                'nom' => 'KOUNASSO',
                'prenom' =>'Tibo',
                'password' => Hash::make('admin'), 
                'email' => 'admin@gmail.com',
                'role' => 'admin',
            ]);

        
    }
}
