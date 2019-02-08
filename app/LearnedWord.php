<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearnedWord extends Model
{
    public function learned_words_number($id)
    {
        $learned_words_number = LearnedWord::where('user_id', $id)->get()->count();

        return $learned_words_number;
    }

    public function learned_words_id($id)
    {
        $learned_words_id = LearnedWord::where('user_id', $id)->get();

        return $learned_words_id;
    }
}
