<?php

namespace App\Helpers;

use Crypt;
use Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
//Models Start
use App\Students;
use App\ClassSec;
use App\OldDues;
use App\FeesDiscount;
use App\FeeStructure;
use App\FeeReceived;
use App\InvoiceParticulars;
//Models End
class Helper
{
	/**
    *get student name and class
    *@param $id is the student id
    *
    *@return
    **/
    public static function getStudentNameClass($id=null){
    	$data = Students::select('student_name','father_name','class')->where('id',$id)->with('classSec')->first();
    	return $data;
    }

    /**
    *get student name with id
    *@param $id as student id encrypted
    *
    *@return
    **/
    public static function getStudentName($id=null){
        $id = self::getDecrypted($id);
        $data = Students::select('student_name')->where('id',$id)->first();
        return $data;
    }

    /**
    *encrypting data
    *@param $data as string
    *
    *@return
    **/
    public static function getEncrypted($data=null){
        $encrypted = str_random(10).Crypt::encryptString($data).str_random(8);
        return $encrypted;
    }

    /**
    *Decrypting Data
    *@param $data as encrypted string
    *
    *@return
    **/
    public static function getDecrypted($encrypted=null){
        try{
            $encrypted  = substr($encrypted,10,-8);
            $decrypted  = Crypt::decryptString($encrypted);  
        }catch(DecryptException $e) {
            request()->session()->flash('status', 'danger');
            request()->session()->flash('msg', 'Something went wrong.');
            header("Location:".route("Class.index"));
            die;
        }
        return $decrypted;
    }

    /**
    *get class and section of student
    *@param class id as $id
    *
    *@return
    **/
    public static function getClassName($id=null){
        $className  = ClassSec::select('clas')->where('id',$id)->first();
        return $className->clas;
    }//getClassName() END

        /**
    *get class and section of student
    *@param class id as $id
    *
    *@return
    **/
    public static function getParticularName($id=null){
        $particularName  = InvoiceParticulars::select('particular')->where('id',$id)->first();
        return $particularName->particular;
    }
    
    
    /**
    *get student due details
    *@param $id as student id encrypted
    *
    *@return
    **/
    public static function getDueDetails($id=null){
        $studentData    =   Students::find($id);
        $oldDuesData    =   OldDues::where('student_id',$id)->where('for_session',self::getSessionList()["currentSession"])->first();
        $discountData       =   FeesDiscount::where('student_id',$id)->where('for_session',self::getSessionList()["currentSession"])->first();
        $feeStructureData   =   FeeStructure::where('class_id',$studentData->class)->first();

        $currentMonth   = date('m');
        $currentQuarter = '';
        if ($currentMonth > 3 && $currentMonth < 7) {
            $currentQuarter = 1;
        }elseif($currentMonth > 6 && $currentMonth < 10) {
            $currentQuarter = 2;
        }elseif ($currentMonth > 9 && $currentMonth < 13) {
            $currentQuarter = 3;
        }else{
            $currentQuarter = 4;
        }
        $feeStructure   = FeeStructure::where('class_id',$studentData->class)->where('month_id','<=',$currentQuarter)->sum('amount');
        $totalSessionFees   = FeeStructure::where('class_id',$studentData->class)->sum('amount');
        $totalFeesPayable   =   (isset($oldDuesData->amount)? $oldDuesData->amount :0) + $totalSessionFees;
        
        $totalFeesReceived  = FeeReceived::where('student_id',$id)->where('for_session',self::getSessionList()["currentSession"])->sum('amount');
        $amountDue      = ((isset($oldDuesData->amount) ? $oldDuesData->amount : 0) + $feeStructure) - $totalFeesReceived;
        $getDueDetails = array('amountDue' =>$amountDue ,'totalFeesPayable'=>$totalFeesPayable,'totalFeesReceived'=>$totalFeesReceived,'currentQuarter'=>$currentQuarter ,'oldDuesData'=>$oldDuesData);
        return $getDueDetails;
    }

    /**
    *get previous ,current, next session list
    *@param 
    *
    *@return
    **/
    public static function getSessionList(){
       if(strtotime(date("d-m-y")) < strtotime("31-03-".date("y"))) {
            $previousSession    =  (date("Y")-2)."-".(date("y")-1);
            $currentSession     =  (date("Y")-1)."-".(date("y"));
            $nextSession        =  (date("Y"))."-".(date("y")+1);
        }else{
            $previousSession    =  (date("Y")-1)."-".(date("y"));
            $currentSession     =  (date("Y"))."-".(date("y")+1);
            $nextSession        =  (date("Y")+2)."-".(date("y")+3);
        }
        $sessionList = array("previousSession"=>$previousSession,"currentSession"=>$currentSession,"nextSession"=>$nextSession);
        return $sessionList;
    }
}