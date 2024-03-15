<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $reviews = [
            "Professionista molto competente! Ha risolto i problemi del mio progetto in modo rapido e efficace. Consigliato!",
            "Lavoro svolto con precisione e attenzione ai dettagli. Consulente molto disponibile.",
            "Purtroppo l'esperienza non è stata positiva. Il lavoro è stato ritardato e la comunicazione è stata scarsa.",
            "Fantastico nel fornire soluzioni innovative e creative. Ha superato le mie aspettative. Grazie!",
            "Consulente molto competente e disponibile. Ha fornito consulenza dettagliata e supporto costante per il mio progetto.",
            "Non sono soddisfatto del risultato finale. Il lavoro svolto non corrisponde alle aspettative.",
            "Professionista molto affidabile e competente. Ha fornito soluzioni efficaci per il mio progetto. Grazie per l'eccellente lavoro!",
            "Consulente molto preparato e disponibile. Ha fornito consulenza dettagliata e supporto costante per il mio progetto. Consigliato!",
            "Sono rimasto deluso dall'esperienza. Il lavoro è stato consegnato in ritardo e con errori.",
            "Straordinario nel fornire soluzioni innovative e creative. Ha superato le mie aspettative. Grazie per l'eccellente lavoro!",
            "Professionista molto preparato e disponibile. Ha fornito consulenza dettagliata e supporto costante per il mio progetto. Consigliato!",
            "Fantastico nel comprendere le esigenze del cliente e nel fornire soluzioni personalizzate. Consigliato!",
            "Consulente molto affidabile e competente. Ha fornito soluzioni efficaci per il mio progetto. Grazie per l'eccellente lavoro!",
            "Eccezionale nel fornire soluzioni su misura per le mie esigenze. Ha superato le mie aspettative. Consigliato!",
            "Professionista molto preparato e disponibile. Ha fornito consulenza dettagliata e supporto costante per il mio progetto. Grazie mille!",
            "Fantastico nel comprendere le esigenze del cliente e nel fornire soluzioni personalizzate. Consigliato!",
            "Consulente molto affidabile e competente. Ha fornito soluzioni efficaci per il mio progetto. Grazie per l'eccellente lavoro!",
            "Non consiglierei questo professionista. Il lavoro è stato di bassa qualità e poco professionale.",
            "Consulente molto disponibile e competente. Ha fornito suggerimenti preziosi per migliorare il mio progetto.",
            "Il lavoro è stato consegnato con ritardo e non ha soddisfatto le mie aspettative.",
            "Professionista molto preparato nel campo della tecnologia. Ha fornito soluzioni efficienti e tempestive. Grazie mille!",
            "Fantastico nel comprendere le esigenze del cliente e nel fornire soluzioni personalizzate. Consigliato!",
            "Consulente molto affidabile e competente. Ha fornito soluzioni efficaci per il mio progetto. Grazie per l'eccellente lavoro!",
            "Eccezionale nel fornire soluzioni su misura per le mie esigenze. Ha superato le mie aspettative. Consigliato!",
            "Professionista molto preparato e disponibile. Ha fornito consulenza dettagliata e supporto costante per il mio progetto. Grazie mille!",
            "Fantastico nel comprendere le esigenze del cliente e nel fornire soluzioni personalizzate. Consigliato!",
            "Consulente molto affidabile e competente. Ha fornito soluzioni efficaci per il mio progetto. Grazie per l'eccellente lavoro!",
            "Non consiglierei questo professionista. Il lavoro è stato di bassa qualità e poco professionale.",
            "Consulente molto disponibile e competente. Ha fornito suggerimenti preziosi per migliorare il mio progetto.",
            "Il lavoro è stato consegnato con ritardo e non ha soddisfatto le mie aspettative.",
        ];
        $professionals = Professional::pluck('id');
        foreach($professionals as $professional){
            $saveReview = rand(0, 2);
            if($saveReview){
                $numberReviews = rand(1,10);
                for($i = 0; $i <= $numberReviews; $i++){
                    $randomReview = rand(0, count($reviews) - 1);
                    $new_review = new Review();
                    $new_review->professional_id = $professional;
                    $new_review->review = $reviews[$randomReview];
                    $new_review->email_reviewer = $faker->email();
                    $new_review->name_reviewer = $faker->firstNameMale() . ' ' . $faker->lastName();
                    $dateTime = $faker->dateTimeBetween('-8 months', '+1 days');
                    $new_review->created_at = $dateTime;
                    $new_review->updated_at = $dateTime;
                    $new_review->save();
                }
            }
        }
    }
}
