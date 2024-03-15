<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Professional;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $messages = [
            "Ciao, sono interessato a sviluppare un'applicazione web per la mia startup. Hai esperienza con l'integrazione di pagamenti online?",
            "Salve! Sto cercando un esperto che possa ottimizzare il backend del mio sito web. Potresti dare un'occhiata?",
            "Buongiorno, sto lavorando su un progetto di machine learning e ho bisogno di assistenza nell'ottimizzazione degli algoritmi. Potresti aiutarmi?",
            "Ciao, sto sviluppando un'app per dispositivi mobili e ho bisogno di supporto per l'integrazione di un sistema di notifiche push. Sei disponibile?",
            "Salve! Sto cercando qualcuno che possa aiutarmi a implementare un modello di intelligenza artificiale per l'analisi dei dati. Puoi darci una mano?",
            "Buongiorno, sto lavorando su un progetto di analisi dati e ho bisogno di un esperto che possa aiutarmi a interpretare i risultati. Sei disponibile per una consulenza?",
            "Ciao, ho bisogno di un professionista che possa sviluppare un'applicazione web con funzionalità di e-commerce. Hai esperienza in questo settore?",
            "Salve! Sto cercando un esperto che possa implementare un'algoritmo di machine learning per la previsione della domanda. Potresti aiutarmi?",
            "Buongiorno, ho bisogno di un consulente per valutare l'architettura del mio progetto di intelligenza artificiale. Sei disponibile per una consulenza tecnica?",
            "Ciao, sto sviluppando un'app per dispositivi mobili e sto cercando un professionista che possa ottimizzare le prestazioni del frontend. Sei disponibile?",
            "Salve! Sto lavorando su un progetto di analisi dei dati e ho bisogno di un esperto che possa aiutarmi a selezionare le migliori tecniche di visualizzazione. Potresti darci una mano?",
            "Buongiorno, sto sviluppando un'applicazione web e ho bisogno di un professionista che possa implementare funzionalità di autenticazione sicura. Sei disponibile?",
            "Ciao, sono interessato a sviluppare un sistema di raccomandazione per il mio sito web. Hai esperienza in questo campo?",
            "Salve! Sto lavorando su un progetto di machine learning e ho bisogno di un esperto che possa aiutarmi a raccogliere e preparare i dati. Sei disponibile?",
            "Buongiorno, sto sviluppando un'applicazione mobile e ho bisogno di un professionista che possa implementare un sistema di localizzazione geografica. Potresti aiutarmi?",
            "Ciao, sto lavorando su un progetto di analisi dati e ho bisogno di un consulente che possa aiutarmi a identificare le variabili più importanti. Sei disponibile?",
            "Salve! Sto sviluppando un'applicazione web e ho bisogno di un esperto che possa ottimizzare le prestazioni del database. Potresti darci una mano?",
            "Buongiorno, sto cercando un professionista che possa sviluppare un'algoritmo di intelligenza artificiale per la classificazione dei dati. Sei disponibile?",
            "Ciao, sono interessato a sviluppare un'applicazione mobile con funzionalità di riconoscimento vocale. Hai esperienza in questo settore?",
            "Salve! Sto lavorando su un progetto di analisi dei dati e ho bisogno di un esperto che possa aiutarmi a identificare i modelli nascosti nei dati. Sei disponibile?",
            "Buongiorno, ho bisogno di un consulente che possa valutare l'efficacia dei modelli di machine learning implementati nel mio progetto. Sei disponibile per una consulenza?",
            "Ciao, sto sviluppando un'applicazione web e ho bisogno di un professionista che possa implementare un sistema di caching per migliorare le prestazioni. Sei disponibile?",
            "Salve! Sto lavorando su un progetto di analisi dei dati e ho bisogno di un esperto che possa aiutarmi a elaborare un piano di pulizia dei dati. Potresti darci una mano?",
            "Buongiorno, sto sviluppando un'applicazione mobile e ho bisogno di un professionista che possa implementare un'interfaccia utente intuitiva. Sei disponibile?",
            "Ciao, sono interessato a sviluppare un sistema di riconoscimento delle immagini per la mia applicazione web. Hai esperienza in questo campo?",
            "Salve! Sto lavorando su un progetto di machine learning e ho bisogno di un esperto che possa aiutarmi a selezionare il modello più adatto al mio problema. Sei disponibile?",
            "Buongiorno, ho bisogno di un consulente che possa valutare la qualità dei dati utilizzati nel mio progetto di intelligenza artificiale. Sei disponibile per una consulenza?",
            "Ciao, sto sviluppando un'applicazione web e ho bisogno di un professionista che possa implementare un sistema di ricerca avanzata. Sei disponibile?",
            "Salve! Sto lavorando su un progetto di analisi dei dati e ho bisogno di un esperto che possa aiutarmi a identificare le correlazioni tra le variabili. Sei disponibile?",
            "Buongiorno, ho bisogno di un consulente che possa valutare l'efficacia delle tecniche di machine learning implementate nel mio progetto. Sei disponibile per una consulenza?",
            "Ciao, sono interessato a sviluppare un'applicazione mobile con funzionalità di realtà aumentata. Hai esperienza in questo campo?",
            "Salve! Sto lavorando su un progetto di analisi dei dati e ho bisogno di un esperto che possa aiutarmi a sviluppare modelli predittivi. Sei disponibile?",
        ];
        $professionals = Professional::pluck('id');
        foreach($professionals as $professional){
            $saveMessage = rand(0, 2);
            if($saveMessage){
                $numberMessage = rand(1,20);
                for($i = 0; $i <= $numberMessage; $i++){
                    $randomMessage = rand(0, count($messages) - 1);
                    $new_message = new Message();
                    $new_message->professional_id = $professional;
                    $new_message->message = $messages[$randomMessage];
                    $new_message->sender_email = $faker->email();
                    $new_message->name = $faker->firstNameMale() . ' ' . $faker->lastName();
                    $dateTime = $faker->dateTimeBetween('-8 months', '+1 days');
                    $new_message->created_at = $dateTime;
                    $new_message->updated_at = $dateTime;
                    $new_message->save();
                }
            }
        }
    }
}
