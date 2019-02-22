<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
    ];
    public function learnedLesson()
    {
        return $this->hasMany(learnedLesson::class);
    }

    public function word()
    {
        return $this->hasMany(Word::class);
    }
}
