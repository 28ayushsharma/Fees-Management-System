<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use App\FeeStructure;
use App\ClassSec;
use App\Months;
use Auth,CustomHelper;

class FeeStructureController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $classes = ClassSec::orderBy('clas')->get();
        $result  = FeeStructure::with('classSec')->with('month')->get();
        return view('Admin.FeeStructure.index',compact('result','classes'));
    }

    /**
     * Show the add form page.
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function add(){
        $classes = ClassSec::orderBy('clas')->get();
        $months  = Months::all(); 
        return view('Admin.FeeStructure.add',compact('classes','months'));
    }

    /**
     * save the fees structure details.
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
        $month = null;
        if(!empty($request->input('month'))){
            $month = CustomHelper::getDecrypted($request->input('month'));
        }
       $rules = [
            'class_id'  => 'required|unique:fees_structure,class_id, 0 ,id,month_id,'.$month,
            'month'     => 'required',
            'amount'    => 'required|numeric'
            ];
        $messages = [
                'class_id.required'     => 'Please select class.',
                'class_id.unique'       => 'Class monthly fees already exists',
                'month.required'        => 'Please select month field.',
                'amount.required'       => 'Please enter amount field.',
                'amount.numeric'        => 'Please enter a number in amount field.',
                
            ];
        $inputData = $request->all();
        if(!empty($inputData['class_id'])){
            $inputData['class_id'] = CustomHelper::getDecrypted($inputData['class_id']);
        }
        if(!empty($inputData['month'])){
            $inputData['month']    = CustomHelper::getDecrypted($request->input('month'));
        }
        //dd($inputData);
        $validator = Validator::make($inputData, $rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            FeeStructure::create([
              'class_id'   => CustomHelper::getDecrypted($request->input('class_id')),
              'month_id'   => CustomHelper::getDecrypted($request->input('month')),
              'amount'     => $request->input('amount'),
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Fees structure saved successfully.');
        }
        return redirect()->route("feestructure.index");
    }//save END

    /**
     * delete the fees structure details.
     * @param null
     *
     * @return 
     */
    public function delete(Request $request,$id=null){
        $id = CustomHelper::getDecrypted($id);
        FeeStructure::find($id)->delete();

        $request->session()->flash('status', 'danger');
        $request->session()->flash('msg', 'Fees Structure deleted successfully.');
        return redirect()->route('feestructure.index');
    }//delete END

    /**
    * Edit the fees structure details.
    * @param null
    *
    * @return 
    */
    public function edit($id){
        $id = CustomHelper::getDecrypted($id);
        $classes = ClassSec::orderBy('clas')->get();
        $months  = Months::all();
        $data = FeeStructure::find($id);
        return view('Admin.feeStructure.edit', compact('data','months','classes'));
    }

    /**
    * Update the fees structure details.
    * @param null
    *
    * @return 
    */
    public function update(Request $request,$id){
        $id = CustomHelper::getDecrypted($id);
        $month = null;
        if(!empty($request->input('month'))){
            $month = CustomHelper::getDecrypted($request->input('month'));
        }
       $rules = [
            'class_id'  => 'required|unique:fees_structure,class_id, '.$id.' ,id,month_id,'.$month,
            'month'     => 'required',
            'amount'    => 'required|numeric'
            ];
        $messages = [
                'class_id.required'     => 'Please select class.',
                'class_id.unique'       => 'Class monthly fees already exists',
                'month.required'        => 'Please select month field.',
                'amount.required'       => 'Please enter amount field.',
                'amount.numeric'        => 'Please enter a number in amount field.',
                
            ];

        $inputData = $request->all();
        if(!empty($inputData['class_id'])){
            $inputData['class_id'] = CustomHelper::getDecrypted($inputData['class_id']);
        }
        if(!empty($inputData['month'])){
            $inputData['month']    = CustomHelper::getDecrypted($request->input('month'));
        }
        
        $validator = Validator::make($inputData, $rules,$messages);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            FeeStructure::find($id)->update([
              'class_id'   => CustomHelper::getDecrypted($request->input('class_id')),
              'month_id'   => CustomHelper::getDecrypted($request->input('month')),
              'amount'     => $request->input('amount'),
            ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Fees structure updated successfully.');
        }
        return redirect()->route("feestructure.index");
    }

    /**
    * Search the fees structure details.
    * @param null
    *
    * @return 
    */
    public function searchClass(Request $request){
        if(!empty($request->get('class_id'))){
            $class_id   = CustomHelper::getDecrypted($request->get('class_id'));
            $classes    = ClassSec::orderBy('clas')->get();
            $result     = FeeStructure::where('class_id',$class_id)->with('classSec')->with('month')->get();
        
            return view('Admin.FeeStructure.index',compact('result','classes'));
        }
        else{
            return redirect()->route('feestructure.index'); 
        }

    }
}
