<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'email',
        'whatsapp',
        'photo',
        'academic_level',
        'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot(['enrolled_at', 'is_paid'])
            ->withTimestamps();
    }

    public function completedLessons()
    {
        return $this->belongsToMany(\App\Syllabus::class, 'lesson_user', 'user_id', 'syllabus_id')
                    ->withTimestamps();
    }

}
