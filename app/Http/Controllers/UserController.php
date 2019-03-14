<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboardView()
    {
        $activities = collect();
        foreach (Auth::user()->relationship as $relationship) {
            foreach ($relationship->user->activity as $activity) {
                $activities->push($activity);
            }
        }
        $activities = $activities->sortByDesc('updated_at');
        return view('/user/dashboard', compact(
            'activities'
        ));
    }
}
