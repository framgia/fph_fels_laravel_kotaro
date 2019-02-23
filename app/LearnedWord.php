<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearnedWord extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id', 'category_id', 'progress_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
