<?php

namespace App\Http\Controllers;

use App\User;
use App\LearnedLesson;
use App\LearnedWord;
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
        $user_model = new User();
        $user_name = $user_model->user_name();
        $user_avatar = $user_model->user_avatar();

        $lesson_model = new LearnedLesson();
        $learned_lesson_number = $lesson_model->learned_lesson_number();

        $word_model = new LearnedWord();
        $learned_words_number = $word_model->learned_words_number();

        return view('/user/dashboard', compact('user_name', 'learned_lesson_number', 'learned_words_number', 'user_avatar'));
    }
}
