@extends('Admin.layouts.default')
@section('title', 'Student Fees Details')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Student Fees Details</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover">
                            <tr class="info">
                                <th>Session</th>
                                <td>{{CustomHelper::getSessionList()["currentSession"]}}</td>
                                <th>Current Quarter</th>
                                <td>{{$feesDetails['currentQuarter']}}</td>
                            </tr>   
                            <tr>
                                <th>Student Name</th>
                                <td>{{$studentData->student_name}}</td>
                                <th>Class &amp; section</th>
                                <td>{{CustomHelper::getClassName($studentData->class)}} {{$studentData->section}}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>{{$studentData->father_name}}</td>
                                <th>Amount Due</th>
                                <td>{{$feesDetails['amountDue']}}</td>
                            </tr>
                            <tr>
                                <th>Over Dues</th>
                                <td>{{isset($feesDetails['oldDuesData']->amount) ? $feesDetails['oldDuesData']->amount : 0}}</td>
                                <th>Reason for Over Dues</th>
                                <td>{{isset($feesDetails['oldDuesData']->description) ? $feesDetails['oldDuesData']->description : "NA"}}</td>
                            </tr>
                            <tr class="success">
                                <th>Total Payable fees of session</th>
                                <td>{{$feesDetails['totalFeesPayable']}}</td>
                                <th>Total Received</th>
                                <td>{{$feesDetails['totalFeesReceived']}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('feesEntry.index')}}">
                            <button type="button" class="btn btn-warning">Back</button>
                        </a>
                        <a href="{{route('feesEntry.payfees',CustomHelper::getEncrypted($studentData->id))}}">
                            <button type="button" class="btn btn-success pull-right">Pay Fees</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
