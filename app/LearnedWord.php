<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LearnedWord extends Model
{
    public function learned_words_number($id)
    {
        $learned_words_number = LearnedWord::where('user_id', $id)->get()->count();

        return $learned_words_number;
    }

    public function learned_words_id()
    {
        $user_id = Auth::id();
        $learned_words_id = LearnedWord::where('user_id', $user_id)->get();

        return $learned_words_id;
    }
}
