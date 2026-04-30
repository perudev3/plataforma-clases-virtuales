<?php

namespace App\Mail;

use App\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseEnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $course;

    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    public function build()
    {
        return $this->subject('Inscripción confirmada')
                    ->view('emails.course-enrollment');
    }
}