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
        $sponsorization1 = new Sponsorization();
        $sponsorization1->price = 2.99;
        $sponsorization1->hours = 24;
        $sponsorization1->save();

        $sponsorization2 = new Sponsorization();
        $sponsorization2->price = 5.99;
        $sponsorization2->hours = 72;
        $sponsorization2->save();

        $sponsorization3 = new Sponsorization();
        $sponsorization3->price = 9.99;
        $sponsorization3->hours = 144;
        $sponsorization3->save();
    }
}
