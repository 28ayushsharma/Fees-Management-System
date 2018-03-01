@extends('Admin.layouts.default')
@section('title', 'Incomplete Student List')
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
                    <h3 class="box-title">Incomplete Student Profiles</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                                            <td>{{($value->student_name)? $value->student_name : "NA" }}</td>
                                            <td>{{($value->father_name) ? $value->father_name : "NA" }}</td>
                                            <td>
                                            <!-- this is for class  -->
                                                {{isset($value->classSec->clas)? $value->classSec->clas : 'NA'}}
                                                {{$value->section}}
                                            </td>
                                            <?php /* <td>
                                                <a href="{{route('Student.view', CustomHelper::getEncrypted($value->id))}}">
                                                    <button type="button" class="btn btn-block btn-info">View</button>
                                                </a>
                                            </td> */ ?>
                                            <td>
                                                <a href="{{route('Student.edit', CustomHelper::getEncrypted($value->id))}}">
                                                    <button type="button" class="btn btn-block btn-primary">Edit</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><center>No Record Found</center></td>
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
@endsection
