<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Sponsorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSponsoredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professionals = Professional::inRandomOrder()->take(10)->get();
        $sponsorizations = Sponsorization::all();

        foreach ($professionals as $professional) {

            $randomSponsorization = $sponsorizations->random();
            $sponsorizationId = $randomSponsorization->id;

            $professional->sponsorizations()->sync([$sponsorizationId => [
                'date_end_sponsorization' => now()->addHours($randomSponsorization->hours),
            ]]);
        }
    }
}
