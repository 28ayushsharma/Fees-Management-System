@extends('Admin.layouts.default')
@section('title', 'Edit Class')
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
      <h3 class="box-title">Edit Class</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="{{route("Class.update",CustomHelper::getEncrypted($classdata->id))}}">
        {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Class</label>
          <div class="col-sm-8">
              <div class="input-group">
                    <input name="class" value="{{$classdata->clas}}{{old('class')}}" type="text" class="form-control">
              </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Section</label>
          <div class="col-sm-8">
              <div class="input-group">
                    <input name="section" value="{{$classdata->section}}{{old('section')}}" type="text" class="form-control">
              </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route("Class.edit",$classdata->id)}}"
             <button type="button" class="btn btn-default ">Reset</button>
        </a>
        <button type="submit" class="btn btn-success pull-right">Update</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
        </div>
    </div>
</section>
@endsection
