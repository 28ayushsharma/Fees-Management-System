<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware;
use Auth,Session,CustomHelper,DB;
//Models
use App\FeeReceived;


class ReportingsController extends Controller{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Admin.FeeEntry.index');
    }//index END

    /**
     * Display amount received collection report
     *
     * @return 
     */
    public function getCollectionReport(Request $request){
        $collectionData = FeeReceived::select(DB::raw('sum(total_amount) as total_amount,user_id,created_at'))->whereDate('created_at',$request->input('date'))->groupby('user_id')->with('userDetails')->get();
        return view('Admin.reportings.collection',compact('collectionData'));
    }//getCollectionReport() END

    public function getCollectionReportDetails(Request $request){
        $id   =  CustomHelper::getDecrypted($request->input('id'));
        $date =  date('Y-m-d',strtotime($request->input('date')));
        $feesData = FeeReceived::where('user_id',$id)->whereDate('created_at',$date)->get();
        return view('Admin.reportings.collection_report_detail',compact('feesData'));
    }//getCollectionReportDetails() END

    /**
     * Fees Received entries
     *
     * @return 
     */
    public function getFeesReceivedData(Request $request){
        if($request->input('invoice_no')){
            $feesData = FeeReceived::orderBy('created_at', 'desc')->where('invoice_no',$request->input('invoice_no'))->with('userDetails')->paginate(config('constants.RECORDS_PER_PAGE'));
        }else{
            $feesData = FeeReceived::orderBy('created_at', 'desc')->with('userDetails')->paginate(config('constants.RECORDS_PER_PAGE'));
        }
        return view('Admin.reportings.fees_received_data',compact('feesData'));
    }//getFeesReceivedData() END
}//ReportingsController END
