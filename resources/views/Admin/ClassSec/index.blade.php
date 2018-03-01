@extends('Admin.layouts.default')
@section('title', 'Class Management')
@section('content')
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Class List</h3>
            </div>
          <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="get" action="{{route('Class.search')}}">
                                <div class="col-md-6">
                                    <select name="class" class="form-control ">
                                        <option selected value="">Select Class</option>
                                        @if(count($searchclass) != 0)
                                            @foreach ($searchclass as $key => $value)
                                                <option
                                                    @if(Request::input('class') != null)
                                                        @if(CustomHelper::getDecrypted(Request::input('class'))==$value->clas)
                                                            selected 
                                                        @endif
                                                    @endif value="{{CustomHelper::getEncrypted($value->clas)}}">{{$value->clas}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-info btn-flat">Search</button>
                                </span>
                            </form>
                        </div>
                        
                        <div class="col-md-2 pull-right">
                            <a href="{{route("Class.add")}}">
                                <button type="button" class="btn btn-block btn-primary">Add</button>
                            </a>
                        </div>
                  </div>
              </div>
              <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Class</th>
                <th>Section</th>
                <th width="25%" colspan="2">Options</th>

              </tr>
              </thead>
              <tbody>
                @if(count($classes) != 0)
                    @foreach ($classes as $key => $value)
                        <tr>
                            <td>{{$value->clas}}</td>
                            <td>{{isset($value->section)?$value->section: 'NA'}}</td>
                            <td>
                                <a href="{{route('Class.edit', CustomHelper::getEncrypted($value->id))}}">
                                    <button type="button" class="btn btn-block btn-primary">Edit</button>
                                </a>
                              </td>
                            <td>
                                <span href="{{route('Class.delete', CustomHelper::getEncrypted($value->id))}}">
                                   <button type="button" class="btn btn-block btn-danger delete">Delete</button>
                                </span>
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
