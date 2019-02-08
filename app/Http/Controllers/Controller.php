<?php

namespace App\Http\Controllers;

use App\LearnedWord;
use App\LearnedLesson;
use App\User;
use App\Word;
use App\Relationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function user_dashboard_view()
    {
        $id = Auth::id();
        $user_model = new User();
        $user_name = $user_model->user_name($id);
        $user_avatar = $user_model->user_avatar($id);

        $learnedlesson_model = new LearnedLesson();
        $learned_lesson_number = $learnedlesson_model->learned_lesson_number($id);

        $learnedword_model = new LearnedWord();
        $learned_words_number = $learnedword_model->learned_words_number($id);

        $relationship_model = new Relationship();
        $relationship_activities = $relationship_model->activities();

        $lesson_model = new LearnedLesson();
        $lesson_activities = $lesson_model->activities();

        $user_activities = collect();
        $user_activities = $user_activities->concat($relationship_activities)->concat($lesson_activities)->sortByDesc('updated_at');

        // dd($user_activities);

        return view('/user/dashboard', compact('user_name', 'learned_lesson_number', 'learned_words_number', 'user_avatar', 'user_activities'));
    }

    public function user_learned_words_list_view($id)
    {
        $user_model = new User();
        $user_name = $user_model->user_name($id);
        $user_avatar = $user_model->user_avatar($id);

        $lesson_model = new LearnedLesson();
        $learned_lesson_number = $lesson_model->learned_lesson_number($id);

        $learnedword_model = new LearnedWord();
        $learned_words_number = $learnedword_model->learned_words_number($id);
        $learned_words_id = $learnedword_model->learned_words_id($id);

        $word_model = new Word();
        $learned_words = $word_model->learned_words($learned_words_id);

        return view('/user/learnedwordslist', compact('user_name', 'user_avatar', 'learned_words_number', 'learned_words', 'learned_lesson_number'));
    }
}

