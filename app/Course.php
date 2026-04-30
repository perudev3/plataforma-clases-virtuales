<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'directed_to',
        'is_paid',
        'price',
        'discount_price',
        'currency',
        'start_date',
        'duration_weeks',
        'hours',
        'modality',
        'has_certificate',
        'certificate_type',
        'has_qr',
        'status',
        'user_id',
        'programa',
        'image',
        'banner',
        'promo_video',

        // NUEVOS
        'is_featured',
        'class_days',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_date' => 'date',
        'is_featured' => 'boolean',
        'is_paid' => 'boolean',
        'has_certificate' => 'boolean',
    ];


    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }

    public function syllabus()
    {
        return $this->hasMany(Syllabus::class)
            ->orderBy('order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['enrolled_at', 'is_paid'])
            ->withTimestamps();
    }

    public function isPaidBy(User $user): bool
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->wherePivot('is_paid', true)
            ->exists();
    }

    public function canAccessLesson(User $user, Syllabus $lesson): bool
    {
        if ($this->isPaidBy($user)) {
            return true;
        }

        return $lesson->order <= 2;
    }

    public function reviews()
    {
        return $this->hasMany(\App\Review::class);
    }
    
    public function teachers()
	{
	    return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'teacher_id')
	                ->withPivot('role')
	                ->withTimestamps();
	}

}
