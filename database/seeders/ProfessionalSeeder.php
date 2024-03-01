<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $user = new User();
        $user->name = 'Mario';
        $user->surname ='Rossi';
        $user->email ='mario.rossi.com';
        $user->password = bcrypt('password');
        $user -> save();
    }
}
