<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    //
    protected $fillable =['school_id','subject_id','level_id','teachers_login_id','photo'];
}
