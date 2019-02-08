<?php

namespace App;

use Illuminate\Support\Facades\Auth;
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
}
