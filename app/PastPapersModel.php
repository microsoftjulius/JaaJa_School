<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastPapersModel extends Model
{
    protected $table = "past_papers";
    protected $fillable = ['teacher_id','class_id','school_id','past_paper_pdf'];
}
