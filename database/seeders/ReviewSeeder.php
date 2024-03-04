<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            'Ottimo insegnante',
            'Bravissimo, consigliato',
            'Tutto perfetto'
        ];
        foreach ($reviews as $review) {
            $new_review = new Review();
            $new_review->professional_id = 1;
            $new_review->review = $review;
            $new_review->email_reviewer = 'mariorossi@example.com';
            $new_review->name_reviewer = 'Mario Rossi';

            $new_review->save();
        }
    }
}
