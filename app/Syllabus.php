<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabus';
    
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'type',
        'video_url',
        'zoom_link',
        'order'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
