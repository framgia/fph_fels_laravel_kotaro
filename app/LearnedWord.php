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

    public function learned_words_id($id)
    {
        $learned_words_id = LearnedWord::where('user_id', $id)->get();

        return $learned_words_id;
    }

    public function store($word_id)
    {
        $store = new LearnedWord();
        $store->word_id = $word_id;
        $store->user_id = Auth::id();
        $store->save();
        return redirect();
    }
}
