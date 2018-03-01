@extends('Admin.layouts.default')
@section('title', 'Fees Entry Form')
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
                            <tr class="warning">
                                <th>Current Quarter</th>
                                <td>{{$feesDetails['currentQuarter']}}</td>
                            </tr>
                            <tr>
                                <th>Student Name</th>
                                <td>{{$studentData->student_name}}</td>
                                <th>Class &amp; section</th>
                                <td>{{CustomHelper::getClassName($studentData->class)}} {{$studentData->section}}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>{{$studentData->father_name}}</td>
                                <th>Amount Due</th>
                                <td>{{$feesDetails['amountDue']}}</td>
                            </tr>
                            <tr class="success">
                                <th>Total Payable fees of session</th>
                                <td>{{$feesDetails['totalFeesPayable']}}</td>
                                <th>Total Received</th>
                                <td>{{$feesDetails['totalFeesReceived']}}</td>
                            </tr>
                        </table>
                    </div>
                    <form class="form-horizontal" method="post" action="{{route('feesEntry.submitfees',CustomHelper::getEncrypted($studentData->id))}}">
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
                        <div class="form-group">
                            <label for="mode_of_payment" class="col-md-2 control-label">Mode of Payment<span style="color:red;">*</span></label>
                            <div class="col-md-8">
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" name="mode_of_payment" value='{{CustomHelper::getEncrypted(config("constants.CASH"))}}'>
                                        Cash
                                    </label>
                                </div>
                                <div class="radio col-md-4">
                                    <label>
                                        <input type="radio" name="mode_of_payment" value='{{CustomHelper::getEncrypted(config("constants.CHEQUE"))}}'>
                                        Cheque
                                    </label>
                                </div>
                                <div class="col-md-12"><span class="text-danger validateMsg">{{$errors->first('mode_of_payment')}}</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <select name="formData[particular][]" class="form-control validateForm">
                                    <option selected value="">Select Particular</option>
                                    @foreach($invoiceParticulars as $particularKey => $particularData)
                                        <option value="{{$particularData->id}}">{{$particularData->particular}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger validateMsg"></span>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                    <input name="formData[amount][]" type="text" class="form-control amount validateForm" placeholder="Amount" value="{{old('amount')}}">
                                    <span class="text-danger validateMsg"></span>
                                </div>
                                
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" id="addmorebutton"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="addmorediv">

                        </div>
                        <div>
                            @for($i=0;$i < count(old('formData')['particular']);$i++)
                                @if(!empty(old('formData')['particular'][$i]))
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <select name="formData[particular][]" class="form-control">
                                                <option selected value=" ">Select Particular</option>
                                                    @foreach($invoiceParticulars as $particularKey => $particularData)
                                                        <option @if(old('formData')['particular'][$i] == $particularData->id) selected @endif value="{{$particularData->id}}">{{$particularData->particular}}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                                                    <input name="formData[amount][]" type="text" class="form-control amount" placeholder="Amount" value="{{old('formData')['amount'][$i]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2"><button type="button" class="btn btn-danger" id="removebutton"><i class="fa fa-minus-circle"></i></button></div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                        <div class="form-group">
                            <label for="total_amount" class="col-md-2 control-label">Total Amount<span style="color:red;">*</span></label>
                            <div class="col-md-10"> 
                                <input name="total_amount" id="totalAmount" type="text" class="form-control validateForm" placeholder="Total Amount" value="{{old('total_amount')}}">
                                <span class="text-danger validateMsg">{{$errors->first('total_amount')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total_amount" class="col-md-2 control-label">Summary</label>
                            <div class="col-md-10"> 
                                <textarea name="summary" class="form-control" rows="4"></textarea>
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
                //event.preventDefault();
            };
        });
    });
</script>
@endsection
