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
        'duration',
        'type',
        'video_url',
        'zoom_link',
        'pdf',
        'is_preview',
        'order'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isCompletedBy(User $user): bool
    {
        return $user->completedLessons()->where('syllabus_id', $this->id)->exists();
    }
}
