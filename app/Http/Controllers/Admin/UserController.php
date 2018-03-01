<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use Auth,View,Hash;
use Mail,CustomHelper;
use App\ClassSec;
use App\User;

class UserController extends Controller{
    /**
    * middleware restriction only superadmin allowed
    *@param null
    *
    * @return view page
    */
    public function __construct(){
        $this->middleware('superAdmin');
    }//constructor END
    /**
     * Show the application dashboard.
     *@param null
     *
     * @return view page
     */
    public function index(){
        $users = User::where('user_role',config('constants.ADMIN'))->get();
        return View::make('Admin.Users.index', compact('users'));
    }

    /**
    * open add user page
    *@param null
    *
    * @return view page
    */
    public function add(){
        return view("Admin.Users.add");
    }//add() END

    /**
    * Save User data
    *@param null
    *
    * @return view page with success msg
    */
    public function save(Request $request){
        $rules = [
            'name'      => 'required|max:255',
            'email'     => 'required|unique:users,email,',
            'password'  => 'required|confirmed|min:6',
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            User::create([
                "name"      => ucwords($request->input('name')),
                "email"     => $request->input('email'),
                "password"  => Hash::make($request->input('password')),
                "user_role" => 2,
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'User added successfully.');
            return redirect()->route("user.index");
        }
    }//save() END

    /**
    * Edit user data
    *@param class id
    *
    * @return view page
    */
    public function edit($id){
        $id       = CustomHelper::getDecrypted($id);
        $userData = User::find($id);
        return view('Admin.Users.edit', compact('userData'));
    }//edit() END

    /**
    * Update user data
    *@param $id as user id
    *
    * @return redirect to index route
    */
    public function update(Request $request,$id){
        $id    = CustomHelper::getDecrypted($id);
        $rules = [
            'name'      => 'required|max:255',
            'email'     => 'required|unique:users,email,'.$id,
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            User::find($id)->update([
                "name"      => ucwords($request->input('name')),
                "email"     => $request->input('email'),
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'User Updated successfully.');
            return redirect()->route("user.index");
        }
    }//update() END

    /**
    * open change password page
    *@param $id as userID
    *
    * @return redirect to index page route
    */
    public function editPassword(Request $request,$id=''){
        $id         = CustomHelper::getDecrypted($id);
        $userData   = User::find($id);
        return view('Admin.Users.editPassword',compact('userData'));
    }//changePassword() END
    
    /**
    * changePassword from database
    *@param $id as userID
    *
    * @return redirect to index page route
    */
    public function updatePassword(Request $request,$id=''){
        $id     = CustomHelper::getDecrypted($id);
        $rules  = [
            'password'  => 'required|confirmed|min:6|max:255',
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            User::find($id)->update([
                "password"  => Hash::make($request->input('password')),
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'User Updated successfully.');
            return redirect()->route("user.index");
        }
    }//updatePassword() END

    /**
    * changeStatus ACTIVATE/DEACTIVATE
    *@param $id as userID
    *
    * @return redirect to index page route
    */
    public function changeStatus(Request $request,$id=''){
        $id         = CustomHelper::getDecrypted($id);
        $userData   = User::find($id);
        if($userData->status == config('constants.ACTIVE')){
            User::find($id)->update([
                "status" => config('constants.INACTIVE')
            ]);
        }else{
            User::find($id)->update([
                "status" => config('constants.ACTIVE')
            ]);
        }
        $request->session()->flash('status', 'success');
        $request->session()->flash('msg', 'Status changes successfully.');
        return redirect()->route("user.index");
    }//changeStatus() END
}//User controller END
