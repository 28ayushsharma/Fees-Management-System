@extends('Admin.layouts.default')
@section('title', 'View Student')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">View Student</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$studentdata->student_name}}</td>
                                </tr>
                                <tr>
                                    <th>Class &amp; Section</th>
                                    <td>{{$studentdata->classSec->clas}} {{$studentdata->section}}</td>
                                </tr>
                                <tr>
                                    <th>Father Name</th>
                                    <td>{{$studentdata->father_name}}</td>
                                </tr>
                                <tr>
                                    <th>Mother Name</th>
                                    <td>{{$studentdata->mother_name}}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{$studentdata->dob}}, <b>Age</b>- {{$studentdata->age}}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>@if($studentdata->gender == config('constants.MALE')) Male @else Female @endif</td>
                                </tr>
                                <tr>
                                    <th>Cast</th>
                                    <td>{{$studentdata->cast}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{$studentdata->address}}</td>
                                </tr>
                                <tr>
                                    <th>Aadhar Number</th>
                                    <td>{{$studentdata->aadhar_no}}</td>
                                </tr>
                                <tr>
                                    <th>Father Number</th>
                                    <td>{{$studentdata->father_mob}}</td>
                                </tr>
                                <tr>
                                    <th>Mother Number</th>
                                    <td>{{$studentdata->mother_mob}}</td>
                                </tr>
                                <tr>
                                    <th>other Number</th>
                                    <td>{{$studentdata->other_number}}</td>
                                </tr>
                                <tr>
                                    <th>Messaging Number</th>
                                    <td>{{$studentdata->msg_no}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$studentdata->email}}</td>
                                </tr>
                                <tr>
                                    <th>Fees Status</th>
                                    <td>@if($studentdata->fees_status == config('constants.FREE')) Free @else Fees Paying @endif </td>
                                </tr>
                                @if($studentdata->fees_status == config('constants.FREE'))
                                    <tr>
                                        <th>Reason for Free Student</th>
                                        <td>
                                            {{$studentdata->reasonForFree->reason}}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($studentdata->status == config('constants.ACTIVE'))
                                            <label class="label label-success">Active</label>
                                        @elseif($studentdata->status == config('constants.TEMP_INACTIVE'))
                                                <label class="label label-warning">Temporary Inactive</label>
                                            @else
                                                <label class="label label-danger">Permanent Inactive</label>
                                        @endif
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('Student.index')}}">
                            <button type="button" class="btn btn-warning">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
<?php 
    /*
        $(document).ready(function(){
            $('.groupid').on('click',function(){
                $.ajax({
                    url : "{{route('Student.viewgroup',$data = CustomHelper::getEncrypted($studentdata->gid))}}",
                    type: "get",
                    beforeSend: function(){
                        $('#overlay').removeClass('hide');
                    },
                    success:function(result){
                        $('.viewgroup').empty();
                        $('.viewgroup').append(result);
                        $('#overlay').addClass('hide');
                    }
                });//ajax end
            });
        });//document end
    */
    ?>
</script>
@endsection
