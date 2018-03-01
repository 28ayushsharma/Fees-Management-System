<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeesDiscount extends Model
{
    //
    protected $table = 'fees_discount';
    protected $fillable = ["student_id", "amount","for_session"];

}//model end
