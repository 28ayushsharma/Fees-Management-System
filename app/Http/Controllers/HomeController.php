<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //return view('front.index');
    	return view('front.interview');
    }

    public function checkSpeed(Request $request){

       	$validator = Validator::make($request->all(),
    		[
    			'min_speed'=>'required|numeric',
    			'max_speed'=>'required|numeric',
    			'readings' =>'required'
    		]);

    	if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
        	$readings = explode(',',$request->readings);
        	$infringementLimit = (count($readings)*10)/100;
        	dd($infringementLimit);
        }
    	die;
    }
}
