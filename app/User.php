<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_name($id)
    {
        $user_name = User::where('id', $id)->first()->name;

        return $user_name;
    }

    public function user_avatar($id)
    {
        $user_avatar = User::where('id', $id)->first()->avatar_url;

        return $user_avatar;
    }

    public function get_ten_users_data($page_number)
    {
        return $five_categories_data = User::orderBy('updated_at', 'desc')->latest()->offset(($page_number - 1) * 10)->limit(10)->get();
    }

    public function store($request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->save();
    }
}
