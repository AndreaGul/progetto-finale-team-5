<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            'Ciao, prova messaggio 1',
            'Potresti aiutarmi con questo progetto?',
            'Volevo alcune informazioni riguardo al corso'
        ];
        foreach ($messages as $message) {
            $new_message = new Message();
            $new_message->professional_id = 1;
            $new_message->message = $message;
            $new_message->sender_email = 'mariorossi@example.com';
            $new_message->name = 'Mario Rossi';

            $new_message->save();
        }
    }
}
