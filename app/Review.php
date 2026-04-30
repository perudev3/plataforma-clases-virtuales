<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'student_name',
        'rating',
        'comment'
    ];

    public function course()
    {
        return $this->belongsTo(\App\Course::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}