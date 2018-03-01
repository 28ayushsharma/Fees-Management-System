@extends('Admin.layouts.default')
@section('title', 'Edit Student')
@section('content')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Student Details</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('Student.update', CustomHelper::getEncrypted($studentData->id))}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">S.R. No</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input name="sr_no" value="@if(empty(old('sr_no'))){{$studentData->sr_no}}@else{{old('sr_no')}}@endif" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Student Name<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <input name="student_name" value="@if(empty(old('student_name'))){{$studentData->student_name}}@else{{old('student_name')}}@endif" type="text" class="form-control" placeholder="Student name">
                                <span class="text-danger">{{$errors->first('student_name')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Father Name<span style="color:red;">*</span></label>
                            <div class="col-md-3">
                                <input name="father_name" value="@if(empty(old('father_name'))){{$studentData->father_name}}@else{{old('father_name')}}@endif" type="text" class="form-control" placeholder="Father name">
                                <span class="text-danger">{{$errors->first('father_name')}}</span>
                            </div>
                            <label class="col-md-2 control-label">Mother Name<span style="color:red;">*</span></label>
                            <div class="col-md-3">
                                <input name="mother_name" value="@if(empty(old('mother_name'))){{$studentData->mother_name}}@else{{old('mother_name')}}@endif" type="text" class="form-control" placeholder="Mother Name ">
                                <span class="text-danger">{{$errors->first('mother_name')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-4 control-label">Date of Birth<span style="color:red;">*</span></label>
                                <div class="col-md-8 input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="dob" type="text" class="form-control dob" value="@if(empty(old('dob'))){{$studentData->dob}}@else{{old('dob')}}@endif" id="datepicker">
                                </div>
                                <span class="col-md-10 col-md-offset-5 text-danger">{{$errors->first('dob')}}</span>
                            </div>
                            <label class="col-md-1 control-label">Age</label>
                            <div class="col-md-3">
                                <input name="age"  type="text" class="form-control age" value="@if(empty(old('age'))){{$studentData->age}}@else{{old('age')}}@endif" placeholder="Student Age">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Class &amp; Section <span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                <!-- select -->
                                    <select name="class" class="form-control ">
                                        @if(count($class) != 0)
                                            @foreach ($class as $key => $value)
                                                <option @if($studentData->class == $value->id) selected @endif value="{{CustomHelper::getEncrypted($value->id)}}">{{$value->clas}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger">{{$errors->first('class')}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <select name="section" class="form-control">
                                        <option selected value="{{($studentData->section) ? $studentData->section : ''}} ">{{($studentData->section)?$studentData->section: 'Select'}}</option>
                                        <option value="">No Section</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" @if($studentData->gender == "M") checked @endif name="gender" value="M">
                                        Male
                                    </label>
                                </div>
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" name="gender" @if($studentData->gender == "F") checked @endif value="F">
                                        Female
                                    </label>
                                </div>
                                <div class="col-md-12"><span class="text-danger">{{$errors->first('gender')}}</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cast<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="radio col-md-2">
                                    <label>
                                        <input type="radio" name="cast" @if($studentData->cast == "SC") checked @endif value="SC">
                                        SC
                                    </label>
                                </div>
                                <div class="radio col-md-2">
                                    <label>
                                        <input type="radio" name="cast"  @if($studentData->cast == "ST") checked @endif value="ST">
                                        ST
                                    </label>
                                </div>
                                <div class="radio col-md-2">
                                    <label>
                                        <input type="radio" name="cast" @if($studentData->cast == "OBC") checked @endif value="OBC">
                                        OBC
                                    </label>
                                </div>
                                <div class="radio col-md-2">
                                    <label>
                                        <input type="radio" name="cast" @if($studentData->cast == "General") checked @endif value="General">
                                        General
                                    </label>
                                </div>
                                <div class="radio col-md-2">
                                    <label>
                                        <input type="radio" name="cast" @if($studentData->cast == "Minority") checked @endif value="Minority">
                                        Minority
                                    </label>
                                </div>
                                <div class="col-md-12"><span class="text-danger">{{$errors->first('cast')}}</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="address" class="form-control" rows="5" placeholder="Enter Student address here">@if(empty(old('address'))){{$studentData->address}}@else{{old('address')}}@endif</textarea>
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aadhar Number</label>
                            <div class="col-sm-8">
                                <input name="aadhar_no" value="@if(empty(old('aadhar_no'))){{$studentData->aadhar_no}}@else{{old('aadhar_no')}}@endif" type="text" class="form-control" placeholder="Enter Aadhar number here">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mobile Numbers<span style="color:red;">*</span></label>
                            <div class="col-sm-3">
                                <input name="father_mob" value="@if(empty(old('father_mob'))){{$studentData->father_mob}}@else{{old('father_mob')}}@endif" type="text" class="form-control" placeholder="Enter Father mobile number here">
                            </div>
                            <div class="col-sm-3">
                                <input name="mother_mob" value="@if(empty(old('mother_mob'))){{$studentData->mother_mob}}@else{{old('mother_mob')}}@endif" type="text" class="form-control" placeholder="Enter Mother mobile number here">
                            </div>
                            <div class="col-sm-3">
                                <input name="other_mob" value="@if(empty(old('other_mob'))){{$studentData->other_number}}@else{{old('other_mob')}}@endif" type="text" class="form-control" placeholder="Enter Other mobile number here">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Messaging Number<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon">+91</span>
                                    <input name="msg_no" value="@if(empty(old('msg_no'))){{$studentData->msg_no}}@else{{old('msg_no')}}@endif" type="text" class="form-control" placeholder="Enter messaging mobile number here">
                                </div>
                                <span class="text-danger">{{$errors->first('msg_no')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email Address</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input name="email_id" value="@if(empty(old('email_id'))){{$studentData->email}}@else{{old('email_id')}}@endif" type="text" class="form-control" placeholder="Enter Email address here">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fee Status<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" name="fees_status" @if(old('fees_status')==config('constants.FREE')) checked @endif value="{{config('constants.FREE')}}">
                                        Free Student
                                    </label>
                                </div>
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" name="fees_status" @if(old('fees_status')==config('constants.NON_FREE')) checked @endif value="{{config('constants.NON_FREE')}}">
                                        Fees Paying Student
                                    </label>
                                </div>
                                <span class="text-danger col-md-12">{{$errors->first('fees_status')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Reason For Free Student</label>
                            <div class="col-sm-8">
                                @foreach($reasonForFreeStudent as $reasonsData)
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="reason_for_free_student" value="{{$reasonsData->id}}">
                                            {{$reasonsData->reason}}
                                        </label>
                                    </div>
                                @endforeach
                                <span class="text-danger">{{$errors->first('reason_for_free_student')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Brother/Sister Studying in the same School</label>
                            <div class="col-sm-4">
                                <select name="siblingClass[]" class="form-control siblingClass">
                                    <option value="" selected>Select Class</option>
                                    @if(count($class) != 0)
                                        @foreach ($class as $key => $value)
                                            <option value="{{CustomHelper::getEncrypted($value->id)}}">{{$value->clas}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="studentList[]" class="form-control studentList">
                                    <option value=" ">Select Student</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" title="Add More" class="btn btn-success" id="addmorebutton"><i class="fa fa-plus-circle"></i></button>
                            </div>
                            <span class="text-danger col-md-12">{{$errors->first('studentList')}}</span>
                        </div>
                        @if(count(old('studentList')) > 0)
                            @foreach(old('studentList') as $siblingId)
                                @if(!empty($siblingId))
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Sibling</label>
                                        <div class="col-sm-4">
                                            <select name="studentList[]" class="form-control studentList">
                                                <option selected value="{{$siblingId}}">{{CustomHelper::getStudentName($siblingId)->student_name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-danger remove"><i class="fa fa-minus-circle"></i></button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <div class="form-group addmore">

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Photo</label>
                            <div class="col-md-8">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <!-- Old dues section-->
                        <hr>
                        <div class="alert alert-info" role="alert">
                            <span class="fa fa-info-circle"></span>
                            <span>&nbsp;If no old dues then dont fill amount (Amount Due/Over Dues)</span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Amount Due</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                    <input name="old_dues" value="@if(empty(old('old_dues'))){{isset($oldDuesData->amount)? $oldDuesData->amount : null}}@else{{old('old_dues')}}@endif" type="text" class="form-control" placeholder="Amount due">
                                </div>
                            </div>
                            <label class="col-md-2 control-label">Old dues for Session</label>
                            <div class="col-md-3">
                                <!-- select -->
                                <select name="for_session" class="form-control ">
                                    @php
                                        $sessionList = CustomHelper::getSessionList();
                                        unset($sessionList['previousSession']);
                                    @endphp
                                    @if(count(CustomHelper::getSessionList()) != 0)
                                        @foreach ($sessionList as $key => $session)
                                            <option @if($key == "currentSession") selected @endif value="{{$session}}">{{$session}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Over Dues Details</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" rows="5" placeholder="Enter over due details">@if(empty(old('description'))){{isset($oldDuesData->description)? $oldDuesData->description : null}}@else{{old('description')}}@endif</textarea>
                            </div>
                        </div>
                        @if(Auth::user()->user_role == config('constants.SUPER_ADMIN'))
                            <hr>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fees Discount</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                        <input name="discount" value="@if(empty(old('discount'))){{isset($feesDisData->amount)? $feesDisData->amount : null}}@else{{old('discount')}}@endif" type="text" class="form-control" placeholder="Fees Discount">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('Student.index')}}">
                            <button type="button" class="btn btn-default ">Back</button>
                        </a>
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<!-- bootstrap datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      endDate: new Date(),
    });
    $(document).ready(function(){
        $('.dob').on('change',function(event){
            var dob = $('.dob').val();
            var dateOfBirth = new Date(dob);
            var now = new Date();
            var age = now.getFullYear() - dateOfBirth.getFullYear();
            var m   = now.getMonth() - dateOfBirth.getMonth();
            if (m < 0 || (m === 0 && now.getDate() < dateOfBirth.getDate())){
                age--;
            }
            $('.age').val(age);
        });

        $('#addmorebutton').on('click',function(){
            $('.addmore').append('<div class="form-group"><label class="col-md-2 control-label">Sibling</label><div class="col-sm-4"><select name="siblingClass[]" class="form-control siblingClass"><option value="" selected>Select Class</option>@if(count($class) != 0) @foreach ($class as $key => $value)<option value="{{CustomHelper::getEncrypted($value->id)}}">{{$value->clas}}</option> @endforeach @endif</select></div><div class="col-sm-4"><select name="studentList[]" class="form-control studentList"><option>Select Student</option></select></div><div class="col-sm-1"><button type="button" class="btn btn-danger remove"><i class="fa fa-minus-circle"></i></button></div></div>');
        });

        $(document).on('click','.remove',function(){
            $(this).parent().parent().remove();
        });

        $(document).on('change','.siblingClass',function(){
            var _this = $(this);
            var csrf  = $('meta[name="csrf-token"]').attr('content');
            var siblingClass = _this.val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{route('Student.getList')}}",
                type:"post",
                data:{siblingClass:siblingClass} ,
                success:function(response){
                    _this.parent().next().find('.studentList').empty();
                    _this.parent().next().find('.studentList').html(response);
                    /*$.each(response.result, function(index, value){
                        _this.parent().next().find('.studentList').append('<option value="">'+value.student_name+'</option>')
                    });*/
                }

            });
        });
    });

</script>
@endsection
