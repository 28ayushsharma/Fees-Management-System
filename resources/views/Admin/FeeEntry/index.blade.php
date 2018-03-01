@extends('Admin.layouts.default')
@section('title', 'Fees Entry')
@section('content')
  
<!-- pnotify css and js -->
<link href=" {{ asset('css\pnotify.custom.min.css') }}" rel="stylesheet">
<script src="{{ asset('js\pnotify.custom.min.js') }}"></script>
<!-- pnotify css and js -->
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b>Fees Entry</b></h3>
                </div>
                  <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type="text" class="form-control stdsearch" placeholder='Enter 3 word eg."abc"'>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive" id="tabledata">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Father name</th>
                                    <th>Class Section</th>
                                    <th width="10%" >Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentdata as $key => $value)
                                    <tr>
                                        <td>{{($value->student_name)? $value->student_name : "NA" }}</td>
                                        <td>{{($value->father_name) ? $value->father_name : "NA" }}</td>
                                        <td>
                                        <!-- this is for class  -->
                                            {{isset($value->classSec->clas)? $value->classSec->clas : 'NA'}}
                                            {{$value->section}}
                                        </td>
                                        <td>
                                            <a href="{{route('feesEntry.getDetails',CustomHelper::getEncrypted($value->id))}}">
                                                <button type="button" class="btn btn-block btn-info">Get Fees Details</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
        /*--Event for student search--*/
        $(document).on('keyup','.stdsearch',function(){
            var sname = $(this).val();
            if(sname.length > 2){
                $.ajax({
                    url     :   '{{route('feesEntry.search')}}',
                    type    :   'get',
                    data    :   {name:sname},
                    beforeSend: function() {
                        $('#overlay').removeClass('hide');
                    },
                    success :   function(result){
                        $('#tabledata').html(result);
                        $('#overlay').addClass('hide');
                    }
                });
            }//endif
        });//student search end        
    });//document end
</script>
@endsection
