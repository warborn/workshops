<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function course()
    {
    	return $this->belongsTo(Course::class, 'course_id');
    }

    public function classroom()
    {
    	return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
