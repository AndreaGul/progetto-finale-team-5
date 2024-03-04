<?php

namespace Database\Seeders;

use App\Models\Professional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professional = new Professional();

        $professional->slug = 'mario-rossi';
        // $professional->curriculum = ;
        $professional->photo = 'https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU';
        $professional->performance = 'Performance esempio';
        $professional->address = 'Via santa croce, 22 (NA)';
        $professional->user_id = 1;

        $professional->save();
    }
}
