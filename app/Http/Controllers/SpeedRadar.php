<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpeedRadar extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //return view('front.index');
    	return view('front.interview');
    }

    public function averageSpeed(Request $request){

       	$validator = Validator::make($request->all(),
    		[
    			'max_speed'=>'required|numeric',
                'min_speed'=>'required|numeric|between:1,'.$request->max_speed,
    			'readings' =>'required'
    		]);

    	if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
        	$readings = explode(',',$request->readings);
        	$infringementLimit = (count($readings)*10)/100;
            $minSpeed = $request->min_speed;
        	$maxSpeed = $request->max_speed;
            
            $limitCounter = 0;
            $sumOfAll = 0;
            for($i=0; $i < count($readings);$i++){
                if($readings[$i] < $minSpeed || $readings[$i] > $maxSpeed){
                    $limitCounter++;
                }
                $sumOfAll = $sumOfAll + $readings[$i];

            }//endforLoop
 
            if($limitCounter > $infringementLimit){
                return "0.0";
            }else{
                return $sumOfAll/count($readings);
            }
        }
    	
    }
}
