<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LearnedLesson extends Model
{
    public function learned_lesson_number($id)
    {
        $learned_lessons_number = LearnedLesson::where('user_id', $id)->get()->count();

        return $learned_lessons_number;
    }

    public function activities()
    {
        $user_data = Auth::user();
        $user_lesson_all = LearnedLesson::where('user_id', $user_data->id)->get();

        $user_lesson_activities = collect();

        foreach ($user_lesson_all as $user_lesson) {
            $category_data = Category::where('id', $user_lesson->category_id)->first();
            $number_of_words = Word::where('category_id', $user_lesson->category_id)->get()->count();
            $user_lesson_activities->push([
                'avatar_url' => $user_data->avatar_url,
                'message' => '<a href="/user/profile/' . $user_data->id . '">You</a> learned ' . $user_lesson->progress_number . ' of ' . $number_of_words . ' words in <a href="/user/category/' . $category_data->id . '">' . $category_data->title . '</a>.',
                'updated_at' => $user_lesson->updated_at,
            ]);
        }

        $user_followed_all = Relationship::where('user_id', $user_data->id)->get();
        foreach ($user_followed_all as $user_followed) {
            $user_followed_data = User::where('id', $user_followed->followed_id)->first();
            $user_followed_lesson_all = LearnedLesson::where('user_id', $user_followed_data->id)->get();

            foreach ($user_followed_lesson_all as $user_followed_lesson) {
                $category_data = Category::where('id', $user_followed_lesson->category_id)->first();
                $number_of_words = Word::where('category_id', $user_followed_lesson->category_id)->get()->count();
                $user_lesson_activities->push([
                    'avatar_url' => $user_followed_data->avatar_url,
                    'message' => '<a href="/user/profile/' . $user_followed_data->id . '">' . $user_followed_data->name . '</a> learned ' . $user_followed_lesson->progress_number . ' words of ' . $number_of_words . ' in <a href="/user/category/' . $category_data->id . '">' . $category_data->title . '</a>.',
                    'updated_at' => $user_followed_lesson->updated_at,
                ]);
            }
        }

        return $user_lesson_activities;
    }

    public function user_activities($id)
    {
        $user_data = User::where('id', $id)->first();
        if ($user_data->id == Auth::id()) {
            $user_data->name = "You";
        }
        $user_lesson_all = LearnedLesson::where('user_id', $user_data->id)->get();

        $user_lesson_activities = collect();

        foreach ($user_lesson_all as $user_lesson) {
            $category_data = Category::where('id', $user_lesson->category_id)->first();
            $number_of_words = Word::where('category_id', $user_lesson->category_id)->get()->count();
            $user_lesson_activities->push([
                'avatar_url' => $user_data->avatar_url,
                'message' => '<a href="/user/profile/' . $user_data->id . '">' . $user_data->name . '</a> learned ' . $user_lesson->progress_number . ' words of ' . $number_of_words . ' in <a href="/user/category/' . $category_data->id . '">' . $category_data->title . '</a>.',
                'updated_at' => $user_lesson->updated_at,
            ]);
        }

        return $user_lesson_activities;
    }
}
