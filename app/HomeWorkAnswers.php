<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeWorkAnswers extends Model
{
    protected $fillable = ['student_id','homework_id','answer_pdf','school_id'];
}
