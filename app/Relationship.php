<?php

namespace App;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public function activities()
    {
        $user_data = Auth::user();
        $user_followed_all = Relationship::where('user_id', $user_data->id)->get();

        $user_followed_activities = collect();

        foreach ($user_followed_all as $user_followed) {
            $user_followed_data = User::where('id', $user_followed->followed_id)->first();
            if ($user_followed->followed_id == Auth::id()) {
                $user_followed_data->name = "You";
            }
            $user_followed_activities->push([
                'avatar_url' => $user_data->avatar_url,
                'message' => '<a href="user/profile/' . $user_data->id . '">You</a> followed <a href="/user/profile/' . $user_followed->followed_id . '">' . $user_followed_data->name . '</a>.',
                'updated_at' => $user_followed->updated_at,
            ]);
        }

        foreach ($user_followed_all as $user_followed) {
            $user_followed_data = User::where('id', $user_followed->followed_id)->first();
            $other_user_followed_all = Relationship::where('user_id', $user_followed_data->id)->get();

            foreach ($other_user_followed_all as $other_user_followed) {
                $other_user_followed_data = User::where('id', $other_user_followed->followed_id)->first();
                if ($other_user_followed->followed_id == Auth::id()) {
                    $other_user_followed_data->name = "You";
                }
                $user_followed_activities->push([
                    'avatar_url' => $user_followed_data->avatar_url,
                    'message' => '<a href="user/profile/' . $user_followed_data->id . '">' . $user_followed_data->name . '</a> followed <a href="/user/profile/' . $other_user_followed_data->followed_id . '">' . $other_user_followed_data->name . '</a>.',
                    'updated_at' => $other_user_followed->updated_at
                ]);
            }
        }

        return $user_followed_activities;
    }
}
