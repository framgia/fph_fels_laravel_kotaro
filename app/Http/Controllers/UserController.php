<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboardView()
    {
        $learnedWordsNumber = app(User::class)::find(auth()->id())->learnedWord->count();
        $learnedLessonsNumber = app(User::class)::find(auth()->id())->learnedLesson->count();

        $activities = collect();

        $followingUsersId = app(User::class)::find(auth()->id())->relationship;
        foreach ($followingUsersId as $followingUserId) {
            $followingUser = app(User::class)::find($followingUserId->following_id);
            $activities[] = collect([
                'message' => 'You followed <a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a>.',
                'avatar_url' => auth()->user()->avatar_url,
                'updated_at' => $followingUserId->updated_at
            ]);
            foreach ($followingUser->relationship as $otherUserId) {
                $otherUser = app(User::class)::find($otherUserId->following_id);
                $activities[] = collect([
                    'message' => '<a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a> followed <a href="/profile/' . $otherUser->id . '">' . $otherUser->name . '</a>.',
                    'avatar_url' => $followingUser->avatar_url,
                    'updated_at' => $otherUserId->updated_at
                ]);
            }
        }

        $learnedLessons = app(User::class)::find(auth()->id())->learnedLesson;
        foreach ($learnedLessons as $learnedLesson) {
            $learnedCategory = app(Category::class)::find($learnedLesson->category_id);
            $activities[] = collect([
                'message' => 'You learned <a href="/Category/' . $learnedCategory->id . '">' . $learnedCategory->title . '</a>.',
                'avatar_url' => auth()->user()->avatar_url,
                'updated_at' => $learnedLesson->updated_at
            ]);
        }

        foreach ($followingUsersId as $followingUserId) {
            $followingUser = app(User::class)::find($followingUserId->following_id);
            foreach ($followingUser->learnedLesson as $learnedLesson) {
                $followingUserCategory = app(Category::class)::find($learnedLesson->category_id);
                $activities[] = collect([
                    'message' => '<a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a> learned ' . $learnedLesson->progress_number . ' words of ' . $followingUserCategory->word->count() . ' in <a href="/category/' . $followingUserCategory->id . '">' . $followingUserCategory->title . '</a>',
                    'avatar_url' => $followingUser->avatar_url,
                    'updated_at' => $learnedLesson->updated_at
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
