<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;

class LoginController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('Admin.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'email'     => 'required|email',
                    'password'  => 'required'
                    ]);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if(Auth::attempt(['email' =>$request->input('email'), 'password' =>$request->input('password')])){
                if(Auth::attempt(['email' =>$request->input('email'), 'password' =>$request->input('password'),'status'=>config('constants.ACTIVE')])){
                    return redirect()->route('Admin.dashboard');
                }else{
                    Auth::logout();
                    $request->session()->flash('status', 'error');
                    $request->session()->flash('msg', 'Your account has been disabled.');
                }
            }else{
                $request->session()->flash('status', 'error');
                $request->session()->flash('msg', 'Incorrect credentials');
            }
        } 
        return redirect("admin");
    }

    public function logout(Request $request)
    {
        //this is to destroy student join session
        if ($request->session()->has('std_join')){
            $request->session()->forget('std_join');
        }   
        Auth::logout();
        return redirect()->route("Admin.login");
    }
}
