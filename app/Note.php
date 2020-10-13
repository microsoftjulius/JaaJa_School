<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected  $fillable=['subject_id','level_id','teacher_id','notes'];
}
