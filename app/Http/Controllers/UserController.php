<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboardView()
    {
        $learnedWordsNumber = Auth::user()->learnedWord->count();
        $learnedLessonsNumber = Auth::user()->learnedLesson->count();
        return view('/user/dashboard', compact(
            'learnedWordsNumber',
            'learnedLessonsNumber'
        ));
    }
}
