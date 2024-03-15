<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $professionals = Professional::pluck('id');
        foreach($professionals as $professional){
            $numberVotes = rand(1,25);
            for($i = 0; $i <= $numberVotes; $i++){
                $randomVote = rand(1, 5);
                $new_vote = new Vote();
                $new_vote->professional_id = $professional;
                $new_vote->lookup_id = $randomVote;
                $dateTime = $faker->dateTimeBetween('-8 months', '+1 days');
                $new_vote->created_at = $dateTime;
                $new_vote->updated_at = $dateTime;
                $new_vote->save();
            }
        }
    }
}
