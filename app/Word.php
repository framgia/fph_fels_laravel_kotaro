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

    public function store($category_id, $request)
    {
        $new_word = new Word();
        $new_word->word = $request->word;
        $new_word->category_id = $request->category_id;

        $p = 1;
        for ($i = 1; $i < 5; $i++) {
            $choicei = "choice" . $i;
            $wrong_answer_p = "wrong_answer_" . $p;
            if ($request->answer == "choice$i") {
                $new_word->answer = $request->$choicei;
            } else {
                $new_word->$wrong_answer_p = $request->$choicei;
                $p++;
            }
        }
        $new_word->save();
    }

    public function get_ten_words_data($category_id, $page_number)
    {
        return $five_categories_data = Word::where('category_id', $category_id)->orderBy('updated_at', 'desc')->latest()->offset(($page_number - 1) * 10)->limit(10)->get();
    }

    public function restore($word_id, $request)
    {
        $word = Word::where('id', $word_id)->first();
        $word->word = $request->word;

        $p = 1;
        for ($i = 1; $i < 5; $i++) {
            $choicei = "choice" . $i;
            $wrong_answer_p = "wrong_answer_" . $p;
            if ($request->answer == "choice$i") {
                $word->answer = $request->$choicei;
            } else {
                $word->$wrong_answer_p = $request->$choicei;
                $p++;
            }
        }
        $word->update();
        return $word->category_id;
    }
}
