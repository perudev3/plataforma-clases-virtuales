<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_user extends Model
{
    protected $table = 'course_user';
    
    protected $fillable = [
        'course_id',
        'user_id',
        'enrolled_at',
        'is_paid',
    ];

}
