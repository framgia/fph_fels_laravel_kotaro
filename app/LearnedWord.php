<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LearnedWord extends Model
{
    public function learned_words_number()
    {
        $user_id = Auth::id();
        $learned_words_number = LearnedWord::where('user_id', $user_id)->get()->count();

        return $learned_words_number;
    }

}
