<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_paid',
        'price',
        'status',
        'user_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
