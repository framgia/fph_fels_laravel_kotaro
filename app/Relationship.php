<?php

namespace App;

use DB;
use App\User;
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
                'message' => '<a href="/user/profile/' . $user_data->id . '">You</a> followed <a href="/user/profile/' . $user_followed->followed_id . '">' . $user_followed_data->name . '</a>.',
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
                    'message' => '<a href="/user/profile/' . $user_followed_data->id . '">' . $user_followed_data->name . '</a> followed <a href="/user/profile/' . $other_user_followed_data->id . '">' . $other_user_followed_data->name . '</a>.',
                    'updated_at' => $other_user_followed->updated_at,
                ]);
            }
        }

        return $user_followed_activities;
    }

    public function number_of_followed($id)
    {
        return $number_of_followed = Relationship::where('user_id', $id)->get()->count();
    }

    public function number_of_follower($id)
    {
        return $number_of_follower = Relationship::where('followed_id', $id)->get()->count();
    }

    public function user_activities($id)
    {
        $user_data = User::where('id', $id)->first();
        if ($user_data->id == Auth::id()) {
            $user_data->name = "You";
        }
        $user_followed_all = Relationship::where('user_id', $user_data->id)->get();
        if ($user_data->id == Auth::id()) {
            $user_data->name = "You";
        }
        $user_followed_activities = collect();



        foreach ($user_followed_all as $user_followed) {
            $user_followed_data = User::where('id', $user_followed->followed_id)->first();
            if ($user_followed_data->id == Auth::id()) {
                $user_followed_data->name = "You";
            }
            $user_followed_activities->push([
                'avatar_url' => $user_data->avatar_url,
                'message' => '<a href="/user/profile/' . $user_data->id . '">' . $user_data->name . '</a> followed <a href="/user/profile/' . $user_followed->followed_id . '">' . $user_followed_data->name . '</a>.',
                'updated_at' => $user_followed->updated_at,
            ]);
        }

        return $user_followed_activities;
    }

    public function store($following_id)
    {
        if ($following_id == Auth::id()) {
        } else {
            $store = new Relationship();
            $store->user_id = Auth::id();
            $store->followed_id = $following_id;
            $store->save();
        }
    }

    public function followed_destroy($followed_id)
    {
        $delete = DB::delete('delete from relationships where followed_id = ' . $followed_id . ' and user_id = ' . Auth::id());
    }

    public function followed_exists($id)
    {
        return $followed_exists = Relationship::where('followed_id', $id)->where('user_id', Auth::id())->exists();
    }
}
