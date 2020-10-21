<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswersModel extends Model
{
    protected $table    = 'answers';
    protected $fillable = ['school_id','answer_pdf','teacher_id','question_id'];
}
