<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use Auth,View;
use Mail,CustomHelper;
use App\ClassSec;
class ClassController extends Controller
{
    protected $client;
    /**
     * Show the application dashboard.
     *@param null
     *
     * @return view page
     */
    public function index(){
        $searchclass = ClassSec::select('clas')->orderBy('clas')->distinct()->get();
        $classes = ClassSec::all();
        return View::make('Admin.ClassSec.index', compact('classes','searchclass'));
    }

    /**
    * Show class add page
    *@param null
    *
    * @return view page
    */
    public function addClass(){
        return view("Admin.ClassSec.addclass");
    }//addClass end

    /**
    * Save Class and section data
    *@param null
    *
    * @return view page with success msg
    */
    public function saveClass(Request $request){
        $rules = [
            'class'    => 'required|unique:class_sec,clas, 0 ,id,section,'.$request->input('section'),
            //'section'  => 'required|max:1',
            ];
        $messages = [
                'class.required'        => 'Please fill class field.',
                'class.unique'          => 'Class & Section already exists.',
                //'section.required'      => 'Please fill section field.'
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
          if ($validator->fails())
          {
              return back()->withErrors($validator)->withInput();
          }else{
            ClassSec::create([
              'clas'        => $request->input('class'),
              'section'     => $request->input('section'),
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Class saved successfully.');
            return redirect()->route("Class.index");
          }
    }//save class & section End

    /**
    * Edit class data
    *@param class id
    *
    * @return view page
    */
    public function editClass($id){
        $id = CustomHelper::getDecrypted($id);
        $classdata = ClassSec::find($id);
        return view('Admin.ClassSec.editClass', compact('classdata'));
    }//editClass end

    /**
    * Update class data
    *@param $id as class id
    *
    * @return redirect to index route
    */
    public function updateClass(Request $request,$id){
        $id = CustomHelper::getDecrypted($id);
        $rules = [
            'class'    => 'required|unique:class_sec,clas,'.$id.',id,section,'.$request->input('section'),
            //'section'  => 'required|max:1',
            ];
        $messages = [
                'class.required'        => 'Please fill class field.',
                'class.unique'          => 'Class & Section already exists.',
                //'section.required'      => 'Please fill section field.'
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
          if ($validator->fails())
          {
              return back()->withErrors($validator)->withInput();
          }else{
            ClassSec::find($id)->update([
                'clas'       => $request->input('class'),
                'section'     => $request->input('section'),
          ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Class Updated successfully.');
            return redirect()->route("Class.index");
          }
    }//update end

    /**
    * delete class from database
    *@param $id as class id
    *
    * @return redirect to index page route
    */
    public function deleteClass(Request $request,$id=''){
        $id = CustomHelper::getDecrypted($id);
        ClassSec::find($id)->delete();

        $request->session()->flash('status', 'danger');
        $request->session()->flash('msg', 'Class deleted successfully.');
        return redirect()->route('Class.index');
    }//deleteClass end

    /**
     * Search class
     *@param null
     *
     * @return view page
     */
    public function searchClass(Request $request){
        if($request->input('class') != null){
            $classInput  = CustomHelper::getDecrypted($request->input('class'));
            $searchclass = ClassSec::select('clas')->orderBy('clas')->distinct()->get();
            $classes     = ClassSec::where('clas','like', '%'.$classInput.'%')->get();
            return view('Admin.ClassSec.index', compact('classes','searchclass'));
        }
        return redirect()->route('Class.index');
    }//searchClass end
}//class controller end
