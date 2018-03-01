<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    //
    protected $table = 'fees_structure';
    protected $fillable = ["class_id", "month_id","amount"];

    //To get the class name
    public function classSec(){
    	return $this->belongsTo('App\ClassSec','class_id');
    }
    //To get the month name
    public function month(){
    	return $this->belongsTo('App\Months','month_id');
    }
}
