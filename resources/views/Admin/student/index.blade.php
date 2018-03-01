@extends('Admin.layouts.default')
@section('title', 'Student Management')
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
                    <h3 class="box-title">Student List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type="text" class="form-control stdsearch" placeholder='Enter 3 word eg."abc"'>
                            </div>
                            <?php /*
                            <!-- Join dropdown-->
                            @if(Session::has('std_join'))
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="studentCount">{{count(Session::get('std_join'))}}</span> Student &nbsp;
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if(count(Session::get('std_join'))>0)
                                            @foreach(Session::get('std_join') as $student)
                                                <li>
                                                    <a href="javascript::void(0)">
                                                    <!--<span class="fa fa-trash text-danger">
                                                    </span>-->
                                                    {{CustomHelper::getStudentNameClass($student)->student_name}}
                                                    {{CustomHelper::getStudentNameClass($student)->classSec->clas}}                          
                                                    </a>    
                                                </li>
                                            @endforeach
                                        @endif
                                        <li>
                                            <a href="javascript::void(0)">
                                                <button type="button" class="btn btn-block btn-warning join">Join Student</button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript::void(0)">
                                                <button type="button" class="btn btn-block btn-danger" id="removeall">Remove All</button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <!--join new end-->
                            @endif
                            <!-- join dropdown end -->
                            */ ?>
                            <div class="col-md-2 pull-right">
                                <a href="{{route("Student.add")}}">
                                    <button type="button" class="btn btn-primary">Add Student</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive" id="tabledata">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5">S.N0.</th>
                                    <th>Name</th>
                                    <th>Father name</th>
                                    <th>Class Section</th>
                                    <th width="25%" colspan="3">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($studentData) > 0)
                                    @foreach($studentData as $key => $value)
                                        @php
                                            $serial_no = config('constants.RECORDS_PER_PAGE') * ($studentData->currentPage()-1) + $key+1;
                                        @endphp
                                        <tr>
                                            <td>
                                               {{$serial_no}} 
                                            </td>
                                            <?php /*
                                            @if(empty($value->gid))
                                                <td>
                                                    <div class="checkbox">
                                                      <label>
                                                        <input data-name="{{$value->student_name}}" class="stdcheck" type="checkbox" value="{{CustomHelper::getEncrypted($value->id)}}">
                                                      </label>
                                                    </div>
                                                </td>
                                            @else
                                                <td>Already Grouped</td>
                                            @endif
                                            */?>
                                            <td>{{($value->student_name)? $value->student_name : "NA" }}</td>
                                            <td>{{($value->father_name) ? $value->father_name : "NA" }}</td>
                                            <td>
                                            <!-- this is for class  -->
                                                {{isset($value->classSec->clas)? $value->classSec->clas : 'NA'}}
                                                {{$value->section}}
                                            </td>
                                            <td>
                                                <a href="{{route('Student.view', CustomHelper::getEncrypted($value->id))}}">
                                                    <button type="button" class="btn btn-block btn-info">View</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('Student.edit', CustomHelper::getEncrypted($value->id))}}">
                                                    <button type="button" class="btn btn-block btn-primary">Edit</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><center>No Record Found</center></td>
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
    <div class="pull-right" id="pagination">
        {{ $studentData->links() }}
    </div>
</section>

  <!-- /.content -->
<script src="{{ asset('js\bootbox.min.js') }}"></script>
<script>
    /**===== Pnotify Function ====**/
    function notice(title,text,type){
        new PNotify({
            title:  title,
            text :  text,
            type :  type,
          });
    };

    $(document).ready(function(){
        $(document).on('keyup','.stdsearch',function(){
            var sname  = $(this).val();
            if(sname.length > 2){
                $.ajax({
                    url     :   '{{route('Student.search')}}',
                    type    :   'get',
                    data    :   {name:sname},
                    beforeSend: function() {
                        $('#overlay').removeClass('hide');
                    },
                    success :   function(result){
                        $('#pagination').empty();
                        $('#tabledata').html(result);
                        $('#overlay').addClass('hide');
                    }
                });
            }
        });//Student Search END
    
    <?php /*
        $(document).on('click','.stdcheck', function(){
            if($(this).is(":checked")){
                var id = $(this).val();
                $.ajax({
                    url: '{{route('Student.createJoin')}}',
                    type: 'get',
                    data: {id:id},
                    beforeSend: function() {
                        $('#overlay').removeClass('hide');
                    },
                    success: function(result){
                        $('#overlay').addClass('hide');
                        notice('Notice..!!',result.msg, result.type);
                        setTimeout(function(){
                            location.reload();
                        }, 500);
                        
                    }
                });
            }
        });//student check

        $(document).on('click','#removeall',function(){
            $.ajax({
                    url     :   '{{route('Student.remove')}}',
                    type    :   'get',
                    beforeSend: function(){
                        $('#overlay').removeClass('hide');
                    },
                    success :   function(){
                        notice('Notice..!!','All student removed from join list.', 'success');
                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    }
                });
        });

        //function to join students
        $('.join').on('click',function(){
            var studentCount = parseInt($('.studentCount').html());
            if(studentCount < 2){
                bootbox.alert("Select atleast 2 student");
            }else{
                if(studentCount){
                    $.ajax({
                        url     :   '{{route('Student.join')}}',
                        type    :   'get',
                        beforeSend: function() {
                            $('#overlay').removeClass('hide');
                        },
                        success :   function(){
                            bootbox.alert("Student joined successfully", function(){
                                location.href = '{{route('Student.index')}}';
                            });

                        }
                    });
                }
            
        });*/ ?>        
    });//Document END
</script>
@endsection
