<table id="example1" class="table table-bordered table-striped">
  	<thead>
  		<tr>
			<th>Invoice Number</th>
			<th>Student Name</th>
			<th>Class</th>
			<th>For Session</th>
			<th>Total Amount</th>
			<th>Entered By</th>
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
				</tr>
			@endforeach
		@else
			<tr>
				<td colspan="5"><center>No Record Found</center></td>
			</tr>
		@endif
	</tbody>
</table>