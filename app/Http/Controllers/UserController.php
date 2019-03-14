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
        $learnedWordsNumber = Auth::user()->learnedWord->count();
        $learnedLessonsNumber = Auth::user()->lesson->count();

        $activities = collect();

        $followingUsersId = Auth::user()->relationship;
        foreach ($followingUsersId as $followingUserId) {
            $followingUser = User::find($followingUserId->following_id);
            $activities[] = collect([
                'message' => 'You followed <a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a>.',
                'avatar_url' => Auth::user()->avatar_url,
                'updated_at' => $followingUserId->updated_at
            ]);
            foreach ($followingUser->relationship as $otherUserId) {
                $otherUser = User::find($otherUserId->following_id);
                $activities[] = collect([
                    'message' => '<a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a> followed <a href="/profile/' . $otherUser->id . '">' . $otherUser->name . '</a>.',
                    'avatar_url' => $followingUser->avatar_url,
                    'updated_at' => $otherUserId->updated_at
                ]);
            }
        }

        $lessons = Auth::user()->lesson;
        foreach ($lessons as $lesson) {
            $learnedCategory = Category::find($lesson->category_id);
            $activities[] = collect([
                'message' => 'You learned <a href="/Category/' . $learnedCategory->id . '">' . $learnedCategory->title . '</a>.',
                'avatar_url' => Auth::user()->avatar_url,
                'updated_at' => $lesson->updated_at
            ]);
        }

        foreach ($followingUsersId as $followingUserId) {
            $followingUser = User::find($followingUserId->following_id);
            foreach ($followingUser->lesson as $lesson) {
                $followingUserCategory = Category::find($lesson->category_id);
                $activities[] = collect([
                    'message' => '<a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a> learned ' . $lesson->progress_number . ' words of ' . $followingUserCategory->word->count() . ' in <a href="/category/' . $followingUserCategory->id . '">' . $followingUserCategory->title . '</a>',
                    'avatar_url' => $followingUser->avatar_url,
                    'updated_at' => $lesson->updated_at
                ]);
            }
        }

        $activities = $activities->sortByDesc('updated_at');

        return view('/user/dashboard', compact(
            'learnedWordsNumber',
            'learnedLessonsNumber',
            'activities'
        ));
    }
}
