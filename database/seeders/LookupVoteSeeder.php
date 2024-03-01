<?php

namespace Database\Seeders;

use App\Models\LookupVote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookupVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $votes = [
            [1, 'Pessimo'],
            [2, 'Scarso'],
            [3, 'Sufficiente'],
            [4, 'Buono'],
            [5, 'Ottimo']
        ];
        foreach($votes as $vote){
            $new_vote = new LookupVote();
            $new_vote->vote = $vote[0];
            $new_vote->text = $vote[1];
            $new_vote->save();
        }
    }
}
