<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboardView()
    {
        $learnedWordsNumber = app(User::class)::find(auth()->id())->learnedWord->count();
        $learnedLessonsNumber = app(User::class)::find(auth()->id())->learnedLesson->count();
        return view('/user/dashboard', compact(
            'learnedWordsNumber',
            'learnedLessonsNumber'
        ));
    }
}
