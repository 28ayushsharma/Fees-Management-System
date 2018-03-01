@extends('Admin.layouts.default')
@section('title', 'Fees Received Entries')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Fees Received Entries</h3>
				</div>
				<div class="box-body">
						<div class="col-md-12">
							<form class="form-inline" method="get">
		                        <div class="form-group">
	                                <label class="control-label">Invoice Number</label>
	                                <input name="invoice_no" type="text" class="form-control" id="invoice_no" value="@if(Request::get('invoice_no')){{Request::input('invoice_no')}}@endif">
	                                <span class="text-danger" id="invoice_valid_msg"></span>
		                        </div>
							  	<button type="submit" class="btn btn-info btn-flat">Search</button>
                                <a href="{{route('reporting.feesReceivedData')}}">
                                    <button type="button" class="btn btn-default btn-flat">Reset</button>
                                </a>
							</form>
						</div>
				 </div>
				  <br>
				<table class="table table-bordered table-striped">
				  	<thead>
				  		<tr>
							<th>Invoice Number</th>
							<th>Student Name</th>
							<th>Class</th>
							<th>For Session</th>
							<th>Total Amount</th>
							<th>Entered By</th>
							<th colspan="2">Option</th>
				  		</tr>
				  	</thead>
				  	<tbody>
						@if(count($feesData)>0)
							@foreach($feesData as $feesDataKey => $feesDataValue)
								<tr>
									<td>{{$feesDataValue->invoice_no}}</td>
									<td>{{CustomHelper::getStudentNameClass($feesDataValue->student_id)->student_name}}</td>
									<td>{{CustomHelper::getClassName(CustomHelper::getStudentNameClass($feesDataValue->student_id)->class)}}</td>
									<td>{{$feesDataValue->for_session}}</td>
									<td>{{$feesDataValue->total_amount}}</td>
									<td>{{isset($feesDataValue->userDetails->name)?$feesDataValue->userDetails->name: "NA"}}</td>
									<td>
										<a href="{{route('feesEntry.edit',CustomHelper::getEncrypted($feesDataValue->id))}}">
                                            <button type="button" class="btn btn-block btn-primary">Edit</button>
                                        </a>
									</td>
									<td>
										<a target="_blank" href="{{route('feesEntry.printInvoice',CustomHelper::getEncrypted($feesDataValue->id))}}">
                                            <button type="button" class="btn btn-block btn-warning">Invoice</button>
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
			  <!-- /.box-body -->
		</div>
			<!-- /.box -->
		<div class="pull-right" id="pagination">
	        {{ $feesData->links() }}
	    </div>
	</div>
	  <!-- /.col -->
</section>
  <!-- /.content -->
  <script>
  	$(document).ready(function(){
  		var invoice_no_reg = /MAS\/\d\d-\d\d\/(\d+)/i;
  		$('#invoice_no').on('keyup',function(){
  			if (!invoice_no_reg.test($(this).val())){
            	$('#invoice_valid_msg').html('Invalid Invoice Number.');
        	}else{
        		$('#invoice_valid_msg').empty();
        	}
  		});
  	});
  </script>
@endsection
