<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use Auth,Session,CustomHelper;
//Models
use App\Students;
use App\ClassSec;
use App\OldDues;
use App\FeesDiscount;
use App\FeeStructure;
use App\FeeReceived;
use App\InvoiceParticulars;


class feesEntryController extends Controller{
    /**
     * middleware restriction only superadmin allowed
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('superAdmin')->only('edit','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $studentdata = Students::where('status',config('constants.ACTIVE'))->with('classSec')->get();
        return view('Admin.FeeEntry.index', compact('studentdata'));
    }//index END
 
    /**
    *Search student with ajax for join
    *@param phrase of student name
    *
    *@return table view
    **/
    public function search(Request $request){
        $name = $request->get('name');
        $studentdata = Students::where('status',config('constants.ACTIVE'))->where('student_name','like','%'.$name.'%')->with('classSec')->get();
        return view('Admin.FeeEntry.search',compact('studentdata'));
    }//searchStudent END

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewInvoiceNo(){
        $prefix     =   "MAS";
        $year       =   substr(CustomHelper::getSessionList()['currentSession'],2);
        $currentSession       =   CustomHelper::getSessionList()['currentSession'];
        $serialNo   = FeeReceived::where('for_session',$currentSession)->max('invoice_serial_no');
        return $prefix."/".$year."/".($serialNo+1);
    }//getNewInvoiceNo() END

    /**
    *get student details 
    *@param student id
    *
    *@return table view
    **/
    public function getDetails(Request $request,$id=""){
        $id = CustomHelper::getDecrypted($id);
        $studentData    = Students::find($id);
        $feesDetails    = CustomHelper::getDueDetails($id);
        return view('Admin.FeeEntry.feesDetails',compact('studentData','feesDetails'));
    }//getDetails() END

    /**
    *get student details 
    *@param student id
    *
    *@return 
    **/
    public function payFees($id=""){
        $id = CustomHelper::getDecrypted($id);
        $studentData    = Students::find($id);
        $feesDetails    = CustomHelper::getDueDetails($id);
        $invoiceParticulars = InvoiceParticulars::all();
        return view('Admin.FeeEntry.feeEntryForm',compact('studentData','feesDetails','invoiceParticulars'));
    }//payFees() END

    /**
    *submit fees and generate invoice
    *@param 
    *
    *@return 
    **/
    public function submitFees(Request $request,$id = ""){
        $rules = [
            'for_session'     => 'required',
            'total_amount'    => 'required|numeric',
            'mode_of_payment' => 'required',
            'summary'         => 'max:255',
            ];
        $messages = [
                'for_session.required'     => 'Please select session.',
                'total_amount.required'    => 'Please enter Total amount.',
                'total_amount.numeric'     => 'Please enter a number in amount field.',
                'mode_of_payment.required' => 'Please select Mode of Payment.',
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            $id = CustomHelper::getDecrypted($id);
            $invoiceNo = self::getNewInvoiceNo();
            $data = FeeReceived::create([
                'invoice_no'        => $invoiceNo,
                'invoice_serial_no' => substr($invoiceNo, 10),
                'student_id'        => $id,
                'for_session'       => $request->input('for_session'),
                'particulars'       => implode(",",$request->input('formData')['particular']),
                'amount'            => implode(",",$request->input('formData')['amount']),
                'total_amount'      => $request->input('total_amount'),
                'mode_of_payment'   => CustomHelper::getDecrypted($request->input('mode_of_payment')),
                'summary'           => $request->input('summary'),
                'user_id'           => Auth::user()->id,
                ]);
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Student saved successfully.');
            return redirect()->route('feesEntry.printInvoice',CustomHelper::getEncrypted($data->id));
        }     
    }//submitFees() END

    /**
    *edit of fees entry
    *@param $id as the fees received id
    *
    *@return 
    **/
    public function edit($id=''){
        $id     = CustomHelper::getDecrypted($id);
        $feeEntryData   = FeeReceived::find($id);
        $invoiceParticulars = InvoiceParticulars::all();
        return view('Admin.FeeEntry.edit',compact('feeEntryData','invoiceParticulars'));
    }//edit() END

    /**
    *update fees entry only by super admin
    *@param $id as the fees received id
    *
    *@return 
    **/
    public function update(Request $request,$id=''){
        $this->middleware('superAdmin');
        $rules = [
            'for_session'     => 'required',
            'total_amount'    => 'required|numeric',
            ];
        $messages = [
                'for_session.required'     => 'Please select session.',
                'total_amount.required'    => 'Please enter Total amount.',
                'total_amount.numeric'     => 'Please enter a number in amount field.',  
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            $id = CustomHelper::getDecrypted($id);
            $invoiceNo = self::getNewInvoiceNo();
            $data = FeeReceived::find($id)->update([
                'particulars'       => implode(",",$request->input('formData')['particular']),
                'amount'            => implode(",",$request->input('formData')['amount']),
                'total_amount'      => $request->input('total_amount'),
                'mode_of_payment'   => CustomHelper::getDecrypted($request->input('')),
                'summary'           => $request->input('summary'),
                'user_id'           => Auth::user()->id,
                ]);
            return redirect()->route('reporting.feesReceivedData');
        }  
    }

    /**
    *for printing invoice 
    *@param $id as the fees received id
    *
    *@return 
    **/
    public function printInvoice($id=''){
        $id     = CustomHelper::getDecrypted($id);
        $data   = FeeReceived::find($id);
        return view('Admin.invoices.receipt',compact('data'));
    }//printInvoice() END
}//feesEntryController END
