<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = new User();
        $user->name = 'Mario';
        $user->surname = 'Rossi';
        $user->email = 'mario.rossi.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
