<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable =['school_id','level_id','parent_id','student_name','age'];
}
