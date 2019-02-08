<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function learned_words_number()
    {
        $id = Auth::id();
        $learned_words_number = Word::where('id', $id)->first();

        return $learned_words_number;
    }
}
