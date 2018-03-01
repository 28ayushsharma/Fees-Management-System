@extends('Admin.layouts.default')
@section('title', 'Edit Fees structure')
@section('content')
    <section class="content">
        <!--Displaying Errors -->
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
                      <h3 class="box-title">Edit Fees Structure</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('feestructure.update',CustomHelper::getEncrypted($data->id))}}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Class</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <select name="class_id" class="form-control ">
                                          <option selected value="">Class</option>
                                            @if(count($classes) != 0)
                                                @foreach ($classes as $key => $value)
                                                    <option @if(!empty(old('class_id')))@if(CustomHelper::getDecrypted(old('class_id'))==$value->id) selected @endif @endif @if($data->class_id == $value->id) selected @endif value="{{CustomHelper::getEncrypted($value->id)}}">
                                                        {{$value->clas}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Month</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-6">
                                        <select name="month" class="form-control ">
                                            <option selected value="">Month</option>
                                            @if(count($months)>0)
                                                @foreach($months as $month)
                                                    <option @if(!empty(old('month')))@if(CustomHelper::getDecrypted(old('month'))==$month->id) selected @endif @endif @if($data->month_id==$month->id) selected @endif value="{{CustomHelper::getEncrypted($month->id)}}">{{$month->month_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-6 input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-inr"></i>
                                        </span>
                                        <input name="amount" type="text" value="@if(empty(old('amount'))){{$data->amount}}@else{{old('amount')}}@endif" class="form-control" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Update</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
