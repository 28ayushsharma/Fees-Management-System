@extends('Admin.layouts.default')
@section('title', 'Edit Fees Entry')
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Enter Fees Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Student Name</th>
                                <td>{{CustomHelper::getStudentNameClass($feeEntryData->student_id)->student_name}}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>{{CustomHelper::getStudentNameClass($feeEntryData->student_id)->father_name}}</td>
                            </tr>
                            <tr>
                            	<th>Class</th>
                            	<td>{{CustomHelper::getClassName(CustomHelper::getStudentNameClass($feeEntryData->student_id)->class)}}</td>
                            </tr>
                        </table>
                    </div>
                    <form class="form-horizontal" method="post" action="{{route('feesEntry.update',CustomHelper::getEncrypted($feeEntryData->id))}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="for_session" class="col-md-2 control-label">For Session<span style="color:red;">*</span></label>
                            <div class="col-md-8">
                                <select name="for_session" class="form-control">
                                    @if(count(CustomHelper::getSessionList())>0)
                                        @foreach(CustomHelper::getSessionList() as $sessionName=>$sessionYear)
                                            <option @if($sessionName == "currentSession") selected @endif value="{{$sessionYear}}">{{$sessionYear}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div>
                            @for($i=0;$i < count(explode(",",$feeEntryData->particulars));$i++)
                                @if(!empty(explode(",",$feeEntryData->particulars)[$i]))
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <select name="formData[particular][]" class="form-control validateForm">
                                                <option selected value="">Select Particular</option>
                                                    @foreach($invoiceParticulars as $particularKey => $particularData)
                                                        <option @if(explode(",",$feeEntryData->particulars)[$i] == $particularData->id) selected @endif value="{{$particularData->id}}">{{$particularData->particular}}</option>
                                                    @endforeach 
                                            </select>
                                            <span class="text-danger validateMsg"></span>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                                <input name="formData[amount][]" type="text" class="form-control amount validateForm" placeholder="Amount" value="{{explode(",",$feeEntryData->amount)[$i]}}">
                                                <span class="text-danger validateMsg"></span>
                                            </div>
                                        </div>
                                        @if($i ==0)
                                        	<div class="col-md-2">
                            					<button type="button" class="btn btn-success" id="addmorebutton"><i class="fa fa-plus-circle"></i></button>
                        					</div>
                                		@else
                                			<div class="col-md-2"><button type="button" class="btn btn-danger" id="removebutton"><i class="fa fa-minus-circle"></i></button></div>
                                		@endif
                                    </div>
                                @endif
                            @endfor
                        </div>
                        <div class="addmorediv">

                        </div>
                        <div class="form-group">
                            <label for="total_amount" class="col-md-2 control-label">Total Amount<span style="color:red;">*</span></label>
                            <div class="col-md-10"> 
                                <input name="total_amount" id="totalAmount" type="text" class="form-control validateForm" placeholder="Total Amount" value="{{$feeEntryData->total_amount}}">
                                <span class="text-danger validateMsg">{{$errors->first('total_amount')}}</span>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right submit">Save &amp; Generate Invoice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('#addmorebutton').on('click',function(){
           $('.addmorediv').append('<div class="form-group"><div class="col-md-5"><select name="formData[particular][]" class="form-control validateForm"><option selected value="">Select Particular</option> @foreach($invoiceParticulars as $particularKey => $particularData)<option value="{{$particularData->id}}">{{$particularData->particular}}</option> @endforeach </select><span class="text-danger validateMsg"></span></div><div class="col-md-5"><div class="input-group"><span class="input-group-addon"><i class="fa fa-inr"></i></span><input name="formData[amount][]" type="text" class="form-control amount validateForm" placeholder="Amount" value="{{old('amount')}}"><span class="text-danger validateMsg"></span></div></div><div class="col-md-2"><button type="button" class="btn btn-danger" id="removebutton"><i class="fa fa-minus-circle"></i></button></div></div>');
        });

        $(document).on('click','#removebutton',function(){
            $(this).parent().parent().remove();
            var totalAmount = 0;
            $(".amount").each(function(index){
                if($.isNumeric($(this).val())) {
                    totalAmount = totalAmount + parseInt($(this).val());
                }
            });
            $('#totalAmount').val(totalAmount);  
        })

        $(document).on('change','.amount',function(){
            var totalAmount = 0;
            $(".amount").each(function(index){
                if($.isNumeric($(this).val())) {
                    totalAmount = totalAmount + parseInt($(this).val());
                }
            });
            $('#totalAmount').val(totalAmount);    
        })

        $('.submit').on('click',function(event){
            var flag = 1 ;
            $('.validateForm').each(function(index){
                if($(this).val() === '' || $(this).val() === null){
                    $(this).parent().find('.validateMsg').html("Please enter data in this field");

                    flag = 0 ;
                }else{
                    $(this).parent().find('.validateMsg').empty();
                } 
            });

            if(flag == 0){
                event.preventDefault();
            };
        });
    });
</script>
@endsection
