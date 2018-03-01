@extends('Admin.layouts.default')
@section('title', 'User Management')
@section('content')
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-2 pull-right">
                        <a href="{{route('user.add')}}">
                            <button type="button" class="btn btn-block btn-primary">Add</button>
                        </a>
                    </div>
              </div>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>User Name</th>
                <th>Email</th>
                <th width="10%">Status</th>
                <th width="30%" colspan="3">Options</th>
              </tr>
              </thead>
              <tbody>
                @if(count($users) > 0)
                    @foreach ($users as $key => $value)
                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td>
                                @if($value->status == config('constants.ACTIVE'))
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Deactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('user.changeStatus', CustomHelper::getEncrypted($value->id))}}">
                                    @if($value->status == config('constants.ACTIVE'))
                                        <button type="button" class="btn btn-block btn-danger">Deactivate</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-success">Activate</button>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{route('user.edit', CustomHelper::getEncrypted($value->id))}}">
                                    <button type="button" class="btn btn-block btn-primary">Edit</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('user.editPassword', CustomHelper::getEncrypted($value->id))}}">
                                    <button type="button" class="btn btn-block btn-warning">Change Password</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4"><center>No Record Found</center></td>
                    </tr>
                @endif
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
  <script src="{{ asset('js\bootbox.min.js') }}"></script>

  <script>
      $(document).ready(function(){
          $('.delete').on('click', function(e){
              e.stopImmediatePropagation();
              e.preventDefault();
              var url = $(this).parent().attr('href');
              bootbox.confirm("Are you sure you want to delete..?", function(result){
                    if(result){
                        window.location.replace(url);
                    }
             });
          });
      });
  </script>
@endsection
