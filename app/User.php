<?php

namespace App;

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

    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function learnedWord()
    {
        return $this->hasMany(LearnedWord::class);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function relationship()
    {
        return $this->hasMany(Relationship::class);
    }

    public function relationshipOrderByUpdatedAtDesc()
    {
        return $this->hasMany(Relationship::class)->orderBy('updated_at', 'desc');
    }
}
