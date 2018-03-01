@extends('Admin.layouts.default')
@section('title', 'Edit User')
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
                    <h3 class="box-title">Edit User</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route("user.update",CustomHelper::getEncrypted($userData->id))}}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-8">
                            <input name="name" value="@if(empty(old('name'))){{$userData->name}}@else{{old('name')}}@endif" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email ID</label>
                        <div class="col-sm-8">
                            <input name="email" value="@if(empty(old('email'))){{$userData->email}}@else{{old('email')}}@endif" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('user.index')}}">
                        <button type="button" class="btn btn-default">Back</button>
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

