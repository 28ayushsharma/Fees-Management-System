@extends('Admin.layouts.default')
@section('title', 'Add New Student')
@section('content')
<section class="content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Student</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route("Student.save")}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">S.R. No</label>
                            <div class="col-md-3">
                                <input name="sr_no" value="{{old('sr_no')}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Student Name<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <input name="student_name" value="{{old('student_name')}}" type="text" class="form-control" placeholder="Student name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Father Name<span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <input name="father_name" value="{{old('father_name')}}" type="text" class="form-control" id="inputEmail3" placeholder="Father name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Class &amp; Section <span style="color:red;">*</span></label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <select name="class" class="form-control ">
                                        <option selected value="">Select Class</option>
                                        @if(count($class) != 0)
                                            @foreach ($class as $key => $value)
                                                <option @if(!empty(old('class'))) @if(CustomHelper::getDecrypted(old('class')) == $value->id) selected @endif @endif value="{{CustomHelper::getEncrypted($value->id)}}">{{$value->clas}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="section" class="form-control">
                                        <option selected value="">Section</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="alert alert-info" role="alert">
                            <span class="fa fa-info-circle"></span>
                            <span>&nbsp;If no old dues then dont fill amount (Amount Due/Over Dues)</span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Amount Due/Over Dues</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                    <input name="old_dues" value="{{old('old_dues')}}" type="text" class="form-control" placeholder="Amount due">
                                </div>
                            </div>
                            <label class="col-md-2 control-label">Old dues for Session</label>
                            <div class="col-md-3">
                                <label class="form-control">{{CustomHelper::getSessionList()["currentSession"]}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Over Dues Details</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" rows="5" placeholder="Enter over due details"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('Student.index')}}">
                            <button type="button" class="col-md-1 btn btn-warning">Back</button>
                        </a>
                        <button type="submit" class=" col-md-1 btn btn-success pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

