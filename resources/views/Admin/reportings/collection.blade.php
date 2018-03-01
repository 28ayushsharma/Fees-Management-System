@extends('Admin.layouts.default')
@section('title', 'Collection Report')
@section('content')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Collection Report</h3>
			</div>
				<div class="box-body">
					<div class="col-md-12">
						<form class="form-inline" method="get">
	                        <div class="form-group">
                                <label class="control-label">Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
	                                <input name="date" type="text" class="form-control" id="datepicker" value="@if(Request::get('date')){{Request::input('date')}}@endif">
	                            </div>
	                        </div>
						  <button type="submit" class="btn btn-info btn-flat">Search</button>
						</form>
					</div>
			  </div>
			  <br>
			<table id="example1" class="table table-bordered table-striped">
			  	<thead>
			  		<tr>
						<th>User Name</th>
						<th>Collection Amount</th>
						<th width="10%">Options</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					@if(count($collectionData)>0)
						@foreach($collectionData  as $collectionkey => $collectionValue)
							<tr>
								<td>{{isset($collectionValue->userDetails->name)?$collectionValue->userDetails->name: "NA"}}</td>
								<td>{{$collectionValue->total_amount}}</td>
								<td>
									<button type="button" data-id="{{CustomHelper::getEncrypted($collectionValue->user_id)}}" data-date='{{$collectionValue->created_at}}' class="btn btn-warning show_details" data-toggle="modal" data-target=".bs-example-modal-lg">Show Details</button>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="3"><center>No Record Found</center></td>
						</tr>
					@endif
				</tbody>
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
    <!-- Large modal -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
			</div>
			<div class="modal-body collectionReport"></div>
	    </div>
	  </div>
	</div>
  <!-- /.content -->
  <!-- bootstrap datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      endDate: new Date(),
    });

    $(document).ready(function(){
    	$('.show_details').on('click',function(){
    		var id   = $(this).attr('data-id');
    		var date = $(this).attr('data-date');
            $.ajax({
                    url: '{{route('reporting.collectionDetails')}}',
                    type: 'get',
                    data: {id:id,date:date},
                    beforeSend: function() {
                        $('#overlay').removeClass('hide');
                    },
                    success: function(result){
                    	$('#overlay').addClass('hide');
                    	$('.collectionReport').empty();
                    	$('.collectionReport').html(result);
                    }
                });
    	});
    });
</script>
@endsection
