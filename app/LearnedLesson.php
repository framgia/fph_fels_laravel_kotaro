<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LearnedLesson extends Model
{
    public function learned_lesson_number()
    {
        $user_id = Auth::id();
        $learned_lessons_number = LearnedLesson::where('user_id', $user_id)->get()->count();

        return $learned_lessons_number;
    }
}
