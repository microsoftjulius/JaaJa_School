<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    //
    protected $fillable=['subject_id','level_id','school_id','teacher_id','home_work'];
}
