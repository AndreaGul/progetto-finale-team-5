<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function lookupVote()
    {
        return $this->belongsTo(LookupVote::class);
    }
}
