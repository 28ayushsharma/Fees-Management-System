@extends('Admin.layouts.default')
@section('title', 'Fees Structure')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b>Fees Structure</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form-horizontal" method="get" action="{{route('feestructure.search')}}">
                                <div class="col-md-6">
                                    <select name="class_id" class="form-control ">
                                        <option selected value="">Select Class</option>
                                        @if(count($classes) != 0)
                                            @foreach ($classes as $key => $data)
                                                <option
                                                    @if(Request::input('class_id') != null)
                                                        @if(CustomHelper::getDecrypted(Request::input('class_id'))==$data->id)
                                                            selected 
                                                        @endif
                                                    @endif value="{{CustomHelper::getEncrypted($data->id)}}">{{$data->clas}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Search</button>
                                </span>
                                <span class="input-group-btn">
                                    <a href="{{route('feestructure.index')}}">
                                        <button type="button" class="btn btn-default btn-flat">Reset</button>
                                    </a>
                                </span>
                            </form>
                        </div>
                        <div class="col-md-2 pull-right">
                              <a href="{{route("feestructure.add")}}">
                                  <button type="button" class="btn btn-block btn-primary">Add</button>
                              </a>
                        </div>
                    </div>
                </div>
                  <br>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Quarter</th>
                                <th>Amount</th>
                                <th width="25%" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($result)>0)
                                @foreach($result as $key=>$data)
                                    <tr>
                                        <td>{{$data->classSec->clas}}</td>
                                        <td>{{isset($data->month->month_name)?$data->month->month_name :'NA'}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>
                                            <a href="{{route('feestructure.edit',CustomHelper::getEncrypted($data->id))}}">
                                                <button type="button" class="btn btn-block btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <button href="{{route('feestructure.delete', CustomHelper::getEncrypted($data->id))}}" type="button" class="btn btn-block btn-danger delete">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <center> No Record Found </center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
              var url = $(this).attr('href');
              bootbox.confirm("Are you sure you want to delete..?", function(result){
                    if(result){
                        window.location.replace(url);
                    }
             });
          });
      });
  </script>
@endsection
