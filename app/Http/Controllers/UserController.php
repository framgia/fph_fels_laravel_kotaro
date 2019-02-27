<?php

namespace App\Http\Controllers;

use App\Word;
use App\User;
use App\Category;
use App\Relationship;
use App\LearnedWord;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userFollowingActivities($id)
    {
        $activities = collect();
        $user = app(User::class)::find($id);
        $followingUsersId = $user->relationshipOrderByUpdatedAtDescTakeTen;
        foreach ($followingUsersId as $followingUserId) {
            $followingUser = app(User::class)::find($followingUserId->following_id);
            if ($id == auth()->user()->id) {
                $user->userName = 'You';
            } else {
                $user->userName = $user->name;
            }
            $activities->push([
                'message' => '<a href="/profile/' . $user->id . '">' . $user->userName . '</a> followed <a href="/profile/' . $followingUser->id . '">' . $followingUser->name . '</a>.',
                'avatar_url' => $user->avatar_url,
                'updated_at' => $followingUserId->updated_at
            ]);
        }
        return $activities;
    }

    public function userLearnedLessonsActivities($id)
    {
        $activities = collect();
        $user = app(User::class)::find($id);
        $learnedLessons = $user->learnedLessonOrderByUpdatedAtDescTakeTen;
        foreach ($learnedLessons as $learnedLesson) {
            if ($id == auth()->user()->id) {
                $user->userName = 'You';
            } else {
                $user->userName = $user->name;
            }
            $learnedCategory = app(Category::class)::find($learnedLesson->category_id);
            $activities->push([
                'message' => '<a href="/Category/' . $user->id . '">' . $user->userName . '</a> learned ' . $learnedLesson->progress_number . ' of ' . $learnedCategory->word->count() . ' words in <a href="/Category/' . $learnedCategory->id . '">' . $learnedCategory->title . '</a>.',
                'avatar_url' => $user->avatar_url,
                'updated_at' => $learnedLesson->updated_at
            ]);
        }
        return $activities;
    }

    public function dashboardView()
    {
        $activities = collect();
        $user = app(User::class)::find(auth()->user()->id);
        $followingUsersId = $user->relationship;

        $activities = $activities->concat($this->userFollowingActivities(auth()->user()->id));
        foreach ($followingUsersId as $followingUserId) {
            $activities = $activities->concat($this->userFollowingActivities($followingUserId->following_id));
        }

        $activities = $activities->concat($this->userLearnedLessonsActivities(auth()->user()->id));
        foreach ($followingUsersId as $followingUserId) {
            $activities = $activities->concat($this->userLearnedLessonsActivities($followingUserId->following_id));
        }

        $activities = $activities->sortByDesc('updated_at');

        return view('/user/dashboard', compact(
            'activities',
            'user'
        ));
    }

    public function profileLearnedWordsView($id)
    {
        $user = app(User::class)::find($id);
        $learnedWords = $user->learnedWord;

        foreach ($learnedWords as $learnedWord) {
            $learnedWord->word = app(Word::class)::find($learnedWord->word_id);
        }

        return view('/user/learnedWords', compact(
            'learnedWords',
            'user'
        ));
    }

    public function profileLearnedLessonsView($id)
    {
        $user = app(User::class)::find($id);
        $activities = $this->userLearnedLessonsActivities($id);
        $activities = $activities->sortByDesc('updated_at');
        return view('/user/learnedLessons', compact('activities', 'user'));
    }

    public function profileView($id)
    {
        $user = app(User::class)::find($id);
        $activities = collect();
        $activities = $activities->concat($this->userFollowingActivities($id));
        $activities = $activities->concat($this->userLearnedLessonsActivities($id));
        $activities = $activities->sortByDesc('updated_at');

        return view('/user/profile', compact('user', 'activities'));
    }

    public function userFollow(Request $request)
    {
        Relationship::create([
            'user_id' => auth()->user()->id,
            'following_id' => $request->id,
        ]);
        return back();
    }

    public function userUnfollow(Request $request)
    {
        Relationship::where('user_id', auth()->user()->id)->where('following_id', $request->id)->delete();
        return back();
    }
}
