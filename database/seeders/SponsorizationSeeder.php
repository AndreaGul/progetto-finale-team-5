<?php

namespace Database\Seeders;

use App\Models\Sponsorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorizarions = [
            [2.99, 24],
            [5.99, 72],
            [9.99, 144]
        ];
        foreach ($sponsorizarions as $sponsorizarion) {
            $new_sponsorizarion = new Sponsorization();
            $new_sponsorizarion->price = $sponsorizarion[0];
            $new_sponsorizarion->hours = $sponsorizarion[1];
            $new_sponsorizarion->save();
        }
    }
}
