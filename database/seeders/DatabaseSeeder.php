<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Professional;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(Faker $faker): void
    {
        $prof_performance=["Sfrutto creatività e logica per affrontare sfide tecnologiche e trasformarle in soluzioni innovative.",
        "Mi immergo nell'oceano di dati, navigando tra complessità per svelare insight nascosti e informazioni preziose.",
        "Costruisco ponti digitali, tessendo codice e tecnologia per creare soluzioni robuste e all'avanguardia.",
        "Vigilo costantemente i confini digitali, mettendo in atto strategie per proteggere dati e sistemi da minacce esterne.",
        "Delineo percorsi intuitivi e accattivanti nell'ecosistema digitale, rendendo l'esperienza utente un viaggio coinvolgente.",
        "Orchestro risorse e talenti, guidando squadre attraverso complessi progetti tecnologici verso il successo.",
        "Rendo fluido il viaggio verso il cloud, ottimizzando risorse digitali per un'efficienza senza pari.",
        "Addestro l'intelligenza artificiale, guidandola nell'apprendimento e nell'evoluzione per risolvere problemi complessi.",
        "Custodisco tesori di informazioni, garantendo la sicurezza e l'integrità dei dati aziendali.",
        "Costruisco strade digitali, eliminando ostacoli tra sviluppo e operazioni per un viaggio senza intoppi verso l'innovazione.",];
        // User::truncate();
        // Professional::truncate();

        for ($i = 0; $i < 10; $i++) {
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
            $professional->performance = collect($prof_performance)->random();
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

        for ($i = 0; $i < 10; $i++) {
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
            $professional->phone = $faker->phoneNumber();
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
