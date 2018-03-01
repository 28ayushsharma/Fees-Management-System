<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use Auth,Config,Session,CustomHelper;
//Models
use App\Students;
use App\ClassSec;
use App\OldDues;
use App\FeesDiscount;
use App\ReasonForFreeStudent;

class StudentController extends Controller
{
    /**
    * Show the application dashboard.
    *@param null
    *
    * @return view page
    */
    public function index(){
        $studentData    = Students::where('status',config('constants.ACTIVE'))->with('classSec')->paginate(config('constants.RECORDS_PER_PAGE'));
        return view('Admin.student.index', compact('studentData'));
    }

    /**
    * Show the application dashboard.
    *@param null
    *
    * @return view page
    */
    public function getIncompleteStudentList(){
        $studentData    = Students::where('status',config('constants.ACTIVE'))->where('is_completed', config('constants.INCOMPLETE'))->with('classSec')->paginate(config('constants.RECORDS_PER_PAGE'));
        return view('Admin.student.incomplete_students', compact('studentData'));
    }

    /**
    * Show student add page
    *@param null
    *
    * @return view page
    */
    public function addstudent(){
        //$class = ClassSec::select('id','class')->groupBy('class')->get();
        $class = ClassSec::select('clas','id')->groupBy('clas')->get();
        return view("Admin.student.addstudent", compact('class'));
    }//addstudent END

    /**
    * Save student data
    *@param null
    *
    * @return view page with success msg
    */
    public function saveStudent(Request $request){
        $rules = [
            'sr_no'        => 'nullable|unique:students,sr_no',
            'student_name' => 'required|max:255',
            'father_name'  => 'required|max:255',
            'class'       => 'required',
            'old_dues'    => 'nullable|numeric',
            'description' => 'required_with:old_dues'
        ];
        $messages = [
            'sr_no.unique'          => "S.R. Number is already taken by any other student.",
            'student_name.required'  => 'Please enter student name.',
            'father_name.required'   => 'Please enter student father name.',
            'class.required'        => 'Please select student class.',
            'old_dues.numeric'      => 'Old Dues amount can only be a number.',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            $data = Students::create([
                'sr_no'        => $request->input('sr_no'),
                'student_name' => $request->input('student_name'),
                'father_name'  => $request->input('father_name'),
                'class'        => CustomHelper::getDecrypted($request->input('class')),
                'section'      => $request->input('section'),
                'status'       => config('constants.ACTIVE'),
                'is_new'       => config('constants.NEW_STUDENT'),
                'is_completed' => config('constants.INCOMPLETE'),
            ]);
            if(!empty($request->input('old_dues'))){
                OldDues::create([
                    "student_id"    => $data->id,
                    "for_session"   => CustomHelper::getSessionList()["currentSession"],
                    'amount'        => $request->input('old_dues'),
                    'description'   => $request->input('description')
                ]);
            }
                
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Student saved successfully.');
            return redirect()->route("Student.index");
        }
    }//saveStudent() END

    /**
    * view student data
    *@param $id as student id
    *
    * @return view page
    */
    public function viewStudent($id=''){
        $id = CustomHelper::getDecrypted($id);
        $studentdata = Students::where('id', $id)->with('classSec')->with('reasonForFree')->first();
        return view('Admin.student.view',compact('studentdata'));
    }//viewStudent() END
    
     /**
    * Edit student data
    *@param student id
    *
    * @return view page
    */
    public function editStudent($id){
        $id = CustomHelper::getDecrypted($id);
        $reasonForFreeStudent = ReasonForFreeStudent::all();
        $studentData    = Students::where('id', $id)->with('classSec')->first();
        $class          = ClassSec::select('clas','id')->groupBy('clas')->get();
        $oldDuesData    = OldDues::where('student_id',$id)
                            ->where('for_session',CustomHelper::getSessionList()["currentSession"])
                            ->first();
        $feesDisData    = FeesDiscount::where('student_id',$id)
                            ->where('for_session',CustomHelper::getSessionList()["currentSession"])
                            ->first();
        return view('Admin.student.editstudent', compact('studentData', 'class','oldDuesData','reasonForFreeStudent','feesDisData'));
    }//editStudent() END
    /**
    * Update student data
    *@param $id as student id
    *
    * @return redirect to index route
    */
    public function updateStudent(Request $request,$id){
        $id = CustomHelper::getDecrypted($id);
        $rules = [
            'sr_no'       => 'nullable|unique:students,sr_no,'.$id,
            'student_name'=> 'required|max:255',
            'father_name' => 'required|max:255',
            'mother_name' => 'required|max:255',
            'class'       => 'required',
            'dob'         => 'required',
            'age'         => 'nullable',
            'gender'      => 'required',
            'cast'        => 'required',
            'address'     => 'required|max:255',
            'father_mob'  => 'nullable',
            'msg_no'      => 'required',
            'fees_status'  => 'required',
            'reason_for_free_student'  => 'required_if:fees_status,'.config('constants.FREE'),
            //'studentList' => 'sometimes|array',
            'old_dues'    => 'nullable|numeric',
            'description' => 'required_with:old_dues',
            'discount'    => 'sometimes|nullable|numeric',
        ];
        $messages = [
            'sr_no.unique'          => "S.R. Number is already taken by any other student.",
            'student_name.required' => 'Please enter student name.',
            'father_name.required'  => 'Please enter student father name.',
            'class.required'        => 'Please select student class.',
            'old_dues.numeric'      => 'Due amount can only be a number.',
            'reason_for_free_student.required_if' => "The reason for free student is required if student is free.",
            "msg_no.required"   =>"Please enter messaging Number.",
            'discount.numeric'  => 'Discount amount can only be a number.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            $siblingids = [];
            if(count($request->input('studentList'))>0){
                foreach($request->input('studentList') as $value){
                    if($value != null){
                        $siblingid = CustomHelper::getDecrypted($value);
                        array_push($siblingids,$siblingid);
                    }
                }
            }
            Students::find($id)->update([
                'sr_no'        => $request->input('sr_no'),
                'student_name' => $request->input('student_name'),
                'father_name'  => $request->input('father_name'),
                'mother_name'  => $request->input('mother_name'),
                'class'        => CustomHelper::getDecrypted($request->input('class')),
                'section'      => $request->input('section'),
                'dob'          => $request->input('dob'),
                'age'          => $request->input('age'),
                'gender'       => $request->input('gender'),
                'cast'         => $request->input('cast'),
                'address'      => $request->input('address'),
                'aadhar_no'    => $request->input('aadhar_no'),
                'father_mob'   => $request->input('father_mob'),
                'mother_mob'   => $request->input('mother_mob'),
                'other_number' => $request->input('other_mob'),
                'msg_no'       =>"+91".$request->input('msg_no'),
                'email'        => $request->input('email_id'),
                'fees_status'  => $request->input('fees_status'),
                'reason_for_free_student'  => $request->input('reason_for_free_student'),
                'sibling_ids'       =>  implode(",", $siblingids),
                'is_completed'      => config('constants.COMPLETE'),
                'last_changed_by'   => Auth::user()->id,
            ]);

            if(!empty($request->input('old_dues'))){
                OldDues::updateOrCreate([
                    'student_id'    => $id,
                    'for_session'   => $request->input('for_session')],
                    ['amount'        => $request->input('old_dues'),
                    'description'   => $request->input('description'),]);
            }

            if(Auth::user()->user_role == config('constants.SUPER_ADMIN') && !empty($request->input('discount'))){
                    FeesDiscount::updateOrCreate([
                    "student_id"    => $id,
                    "for_session"   => CustomHelper::getSessionList()['currentSession']],
                    ["amount"       => $request->input('discount')]); 
            }
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Student Updated successfully.');
            return redirect()->route("Student.index");
        }
    }//updateStudent() END

    /**
    *search student with ajax for join
    *@param phrase of student name
    *
    *@return table view
    **/
    public function searchStudent(Request $request){
        $name = $request->get('name');
        $studentdata = Students::where('status',config('constants.ACTIVE'))->where('student_name','like','%'.$name.'%')->with('classSec')->get();
        return view('Admin.student.search',compact('studentdata'));
    }//searchStudent END
    
    /**
    *get sibling class student list
    *@param 
    *
    *@return table view
    **/
    public function getList(Request $request){
        $siblingClass = CustomHelper::getDecrypted($request->get('siblingClass'));
        $siblingList  = Students::where('status',config('constants.ACTIVE'))->where('class',$siblingClass)->get();
        return view('Admin.student.studentListDropdown',compact('siblingList')); 
    }
    /**
    *create session array for all the student list
    *@param 
    *
    *@return
    **/
    /*
    public function createJoin(Request $request){
        $newid = CustomHelper::getDecrypted($request->get('id'));
        $value = $request->session()->get('std_join');
        if(!empty($newid)){
            if(!empty($value)){
                if(in_array($newid, $value)){
                    return response()->json([
                        'msg' => 'Student already exist in the list.',
                        'type'=> 'error'
                    ]);
                }else{
                    array_push($value, $newid);
                    session(['std_join' => $value]);
                }
            }else{

                //This will work for first time only
                $value = [];
                array_push($value, $newid);
                $request->session()->put('std_join',$value);
            }
        }
        $allid = $request->session()->get('std_join');
        return response()->json([
            'msg' => 'Student added in list successfully',
            'type'=> 'success'
        ]);
    }//createJoin end
    */
    /**
    *join student
    *@param
    *
    *@return
    **/
    /*
    public function joinStudent(Request $request){
        $gid = Session::get('std_join');
        $students   =   Students::whereIn('id',$gid)->get();
        $groupid    =   implode(",",$gid);
        if(count($students)>0){
            foreach ($students as $key => $student){
                $student->update(['gid' => $groupid]);
            }
        }
        Session::forget('std_join');
        return;
    }//joinStudent end
    */
    /**
    *view join student
    *@param group id
    *
    *@return
    **/
    /*
    public function viewGroupStudent(Request $request, $gid){
        $gid = CustomHelper::getDecrypted($gid);
        $studentdata = Students::whereIn('id', explode(",",$gid))->get();
        return view('Admin.student.viewgroup',compact('studentdata'));
    }//viewGroupStudent end
    */
    /**
    *For resetting session
    *@param null
    *
    *@return null
    **/
    /*
    public function removeStudent(){
        Session::forget('std_join');
        return;
    }//removeStudent end
    */
}//StudentController end
