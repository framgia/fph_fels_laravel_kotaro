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

    public function learned_words($learned_words_id)
    {
        $learned_words = [];
        foreach ($learned_words_id as $learned_word_id) {
            $learned_words[] = Word::where('id', $learned_word_id->word_id)->first();
        }

        return $learned_words;
    }
}
