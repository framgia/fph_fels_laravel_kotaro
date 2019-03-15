<?php

namespace App\Http\Controllers;

use App\User;
use App\Lesson;
use App\Category;
use App\Relationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function dashboardView()
    {
        $usersId = [];
        foreach (Auth::user()->relationship as $relationship) {
            $usersId[] = $relationship->following_id;
        }
        $usersId[] = Auth::user()->id;
        $activities = collect();
        foreach ($usersId as $userId) {
            $user = User::find($userId);
            $user->id == Auth::user()->id ? $user->name = "You" : "";
            foreach (User::find($userId)->activity as $activity) {
                if ($activity->action_type == "App\Relationship") {
                    try {
                        $follow = Relationship::findOrFail($activity->action_id);
                    } catch (ModelNotFoundException $e) {
                        return $e->getMessage();
                    }
                    try {
                        $otherUser = User::findOrFail($follow->following_id);
                    } catch (ModelNotFoundException $e) {
                        return $e->getMessage();
                    }
                    $otherUser->id == Auth::user()->id ? $otherUser->name = "You" : "";
                    $activity->avatar_url = $user->avatar_url;
                    $activity->message = "<a href='#'>" . $user->name . "</a> followed <a href='#'>" . $otherUser->name . "</a>";
                } elseif ($activity->action_type == "App\Lesson") {
                    try {
                        $lesson = Lesson::findOrFail($activity->action_id);
                    } catch (ModelNotFoundException $e) {
                        return $e->getMessage();
                    }
                    $activity->message = "<a href='#'>" . $user->name . "</a> learned <a href='#'>" . Category::find($lesson->category_id)->title . "</a>";
                }
                $activities->push($activity);
            }
        }
        $activities = $activities->sortByDesc('updated_at');
        return view('/user/dashboard', compact(
            'activities'
        ));
    }
}
