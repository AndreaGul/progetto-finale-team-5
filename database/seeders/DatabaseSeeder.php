<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Professional;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(Faker $faker): void
    {

        // User::truncate();
        // Professional::truncate();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = $faker->firstNameMale();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->password = bcrypt('password');
            $user->save();

            $professional = new Professional();

            $professional->slug = $user->name . '-' . $user->surname;
            // $professional->curriculum = ;
            $professional->photo =  'https://randomuser.me/api/portraits/men/' . $i . '.jpg';
            $professional->performance = $faker->sentence();
            $professional->address = $faker->address();
            $professional->user_id = $user->id;

            $professional->save();
            $specializationIds = Specialization::pluck('id')->toArray();
            // dd($specializationIds);
            $prova = array_rand($specializationIds, 2);
            // dd($prova);
            $nuovo = [];
            foreach ($prova as $indice) {
                $valore = $specializationIds[$indice];
                $nuovo[] = $valore;
            }
            // dd($nuovo);
            $professional->specializations()->sync($nuovo);
        }

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = $faker->firstNameFemale();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->password = bcrypt('password');
            $user->save();

            $professional = new Professional();

            $professional->slug = $user->name . '-' . $user->surname;
            // $professional->curriculum = ;
            $professional->photo =  'https://randomuser.me/api/portraits/women/' . $i . '.jpg';
            $professional->performance = $faker->sentence();
            $professional->address = $faker->address();
            $professional->user_id = $user->id;

            $professional->save();
            $specializationIds = Specialization::pluck('id')->toArray();
            // dd($specializationIds);
            $prova = array_rand($specializationIds, 2);
            // dd($prova);
            $nuovo = [];
            foreach ($prova as $indice) {
                $valore = $specializationIds[$indice];
                $nuovo[] = $valore;
            }
            $professional->specializations()->sync($nuovo);
        }
    }
}
