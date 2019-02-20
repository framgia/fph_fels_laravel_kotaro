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
        'name', 'email', 'password', 'avatar_url'
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
        return $five_categories_data = User::select('id', 'name', 'email')->where('admin', '0')->orderBy('updated_at', 'desc')->latest()->offset(($page_number - 1) * 10)->limit(10)->get();
    }

    public function get_ten_all_users_data($page_number)
    {
        return $five_categories_data = User::select('id', 'avatar_url', 'name', 'email')->orderBy('updated_at', 'desc')->latest()->offset(($page_number - 1) * 10)->limit(10)->get();
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

    public function get_ten_admins_data($page_number)
    {
        return $five_categories_data = User::select('id', 'name', 'email')->where('admin', '1')->orderBy('updated_at', 'desc')->latest()->offset(($page_number - 1) * 10)->limit(10)->get();
    }

    public function admin_store($request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $new_admin = new User();
        $new_admin->name = $request->name;
        $new_admin->email = $request->email;
        $new_admin->password = Hash::make($request->password);
        $new_admin->admin = true;
        $new_admin->save();
    }
}
