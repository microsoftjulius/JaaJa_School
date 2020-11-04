<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeWorkMarks extends Model
{
    protected $fillable = ['student_id','teacher_id','school_id','home_work_id','marks'];
}
