<!DOCTYPE html>
<html>
	<head>
		<title>Invoice</title>
		<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
		<style type="text/css">
			#reciept-container{
				width: 148.5mm;
				height: 105mm;
				border: 3px solid;
				position: relative;
			}
			.hr-margin-handle{
				margin-top: 5px;
				margin-bottom: 5px;
			}
			.heading-padding-5{
				margin-bottom: 5px;
				margin-top: 5px;
			}
			#reciept-container .table{
				margin-bottom: 5px;
			}
			#note{
				position: absolute;
				bottom: 0px;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div id="reciept-container">
				<h4 class="text-center h5 heading-padding-5">Reciept</h4>
				<h3 class="text-center h4 heading-padding-5">Modern Academy Sr. Sec. School</h4>
					<h4 class="text-center h5 heading-padding-5">Gandhi Path, Vaishali Nagar, Jaipur-302020</h4>
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-6">Reciept No: {{$data->invoice_no}}</div>
							<div class="col-sm-6">Phone No: 0141-123456</div>
						</div>
						<hr class="hr-margin-handle" />
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-6">Student Name: {{ucwords(CustomHelper::getStudentNameClass($data->student_id)->student_name)}}</div>
							<div class="col-sm-6">Class &amp; Section: {{CustomHelper::getClassName(CustomHelper::getStudentNameClass($data->student_id)->class)}}</div>
						</div>
						<div class="row">
							<div class="col-sm-6">Father Name: {{ucwords(CustomHelper::getStudentNameClass($data->student_id)->father_name)}}</div>
							<div class="col-sm-6">Date of Payment: {{date('d-m-y',strtotime($data->created_at))}}</div>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th scope="col">S.No.</th>
									<th scope="col">Particulars</th>
									<th scope="col">Amounts</th>
								</tr>
							</thead>
						<tbody>
								@for($i=0;count(explode(",",$data->particulars))>$i; $i++)
									<tr>
										<td>{{$i+1}}</td>
										<td>{{CustomHelper::getParticularName(explode(",",$data->particulars)[$i])}}</td>
										<td>{{explode(",",$data->amount)[$i]}}</td>
									</tr>
								@endfor
								<tr>
									<th colspan="2">Total</th>
									<td>{{$data->total_amount}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-6">Paid By: 
								@if($data->mode_of_payment == config("constants.CASH"))
									CASH
								@elseif($data->mode_of_payment == config("constants.CHEQUE"))
									CHEQUE
									@else
									Not Available
								@endif
							</div>
							<div class="col-sm-6 text-justify">Total Fees Recieved: {{CustomHelper::getDueDetails($data->student_id)['totalFeesReceived']}}</div>
							<div class="col-sm-6 text-justify">Amount Due: {{CustomHelper::getDueDetails($data->student_id)['amountDue']}}</div>
							<div class="col-sm-6 text-justify">Total Fees Payable: {{CustomHelper::getDueDetails($data->student_id)['totalFeesPayable']}}</div>
							<br /><br />
							<div class="col-md-12">Cashier:</div>
						</div>
					</div>
					<div class="col-md-12 small" id="note">
						All the mentioned Amount once paid are non refundable in any case whatsoever.
					</div>
				</div>
			</div>
			<br/>
			<a target="_blank" href="{{route('feesEntry.index')}}">
				<button class="btn btn-success">Back</button>
			</a>
		</body>
	</html>