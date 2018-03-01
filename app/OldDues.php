<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldDues extends Model
{
    //
    protected $table = 'old_dues';
    protected $fillable = ["student_id", "for_session","amount","description"];

}//model end
