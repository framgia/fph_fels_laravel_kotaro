<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user_and_follwed_history()
    {
        $user_id = Auth::id();
        $followed_ids = Relationship::select('followed_id')->where('user_id', $user_id)->get();

        $followed_users_id[] = $user_id;
        foreach ($followed_ids as $followed_id) {
            $followed_users_id[] = $followed_id->followed_id;
        }

        $user_activities = [];

        foreach ($followed_users_id as $followed_user_id) {
            $user = User::where('id', $followed_user_id)->first();
            $user_followed_histories = Relationship::where('user_id', $user_id)->get();
            foreach ($user_followed_histories as $user_followed_history) {
                $followed_user_name = User::where('id', $user_followed_history->followed_id)->first();

                $user_activities = [
                    'user_avatar_url' => $user->avatar_url,
                    'message' => $user->name.' followed '.$followed_user_name.'.',
                    'updated_at' => $user_followed_history->updated_at,
                ];
            }
        }

        return $user_activities;
    }
}
