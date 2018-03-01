<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeReceived extends Model
{
    //
    protected $table = 'fees_received';
    protected $fillable = ["invoice_no","invoice_serial_no","particulars","for_session","student_id", "amount","total_amount","mode_of_payment","summary","user_id"];

    /**
    * relationship with user_id and User model
    **/
    public function userDetails(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
