<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = ["Web Development", "Mobile Development", "Artificial Intelligence", "Machine Learning", "Data Analysis"];
        foreach($specializations as $specialization){
            $new_specialization = new Specialization();
            $new_specialization->name = $specialization;
            $new_specialization->save();
        }
    }
}
