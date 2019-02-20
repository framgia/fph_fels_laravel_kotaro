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

    public function get_lesson_words($category_id, $progress_number)
    {
        $lesson_words = Word::where('category_id', $category_id)->get();

        return $lesson_word = $lesson_words[$progress_number];
    }

    public function all_lesson_words($category_id)
    {
        $lesson_words = Word::where('category_id', $category_id)->get();

        return $lesson_words;
    }

    public function get_number_of_lesson_words($category_id)
    {
        return $number_of_lesson_words = Word::where('category_id', $category_id)->get()->count();
    }

    public function get_word_by_id($word_id)
    {
        return $word = Word::where('id', $word_id)->first();
    }
}
