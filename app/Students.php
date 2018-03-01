<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //
    protected $table = 'students';
    protected $fillable = ["sr_no","gid","student_name", "father_name","mother_name", "class", "section","dob","age","gender","cast","address","aadhar_no","father_mob","mother_mob","other_number","msg_no","email","fees_status","reason_for_free_student","sibling_ids","photo","status","is_new","is_completed","last_changed_by"];

    /**
    * Get the class that owns the student.
    **/
    public function classSec(){
        return $this->belongsTo('App\ClassSec', 'class');
    }

    /**
    * reason if student is free
    **/
    public function reasonForFree(){
        return $this->belongsTo('App\ReasonForFreeStudent', 'reason_for_free_student');
    }
}//model end
