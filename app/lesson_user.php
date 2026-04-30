<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lesson_user extends Model
{
    protected $table = 'lesson_user';
    
    protected $fillable = [
        'course_id',
        'syllabus_id',
        'completed_at',
    ];
}
