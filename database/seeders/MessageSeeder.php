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
        $message = new Message();

 
       $message->message = 'Ciao';
        $message->sender_email = 'mariorossi@example.com';
        $message->name = 'Mario Rossi';

        $message->save();
    }
}
