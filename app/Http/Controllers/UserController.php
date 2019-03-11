<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboardView()
    {
        $learnedWordsNumber = auth()->user()->learnedWord->count();
        $learnedLessonsNumber = auth()->user()->learnedLesson->count();
        return view('/user/dashboard', compact(
            'learnedWordsNumber',
            'learnedLessonsNumber'
        ));
    }
}
