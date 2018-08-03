<!DOCTYPE html>
<html lang="en">
<head>

	<link href="{{asset('front/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- js -->
	<script type="text/javascript" src="{{asset('front/js/jquery-2.1.4.min.js')}}"></script>
	<!-- //js -->
</head>
<body>
	@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<div class="container">
		<form method="post" action="{{route('check_speed')}}">
			{{ csrf_field() }}
			<div class="form-group">
	            <label class="col-sm-2 control-label">Min Speed</label>
	            <div class="col-sm-10">
	                <input name="min_speed" type="text" class="form-control"
	                value="{{old('min_speed')}}">
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="col-sm-2 control-label">Max Speed</label>
	            <div class="col-sm-10">
	                <input name="max_speed" type="text" class="form-control" value="{{old('max_speed')}}">
	            </div>
	        </div>

	        <div class="form-group">
	            <label class="col-sm-2 control-label">Readings</label>
	            <div class="col-sm-10">
	                <input name="readings" type="text" class="form-control" value="{{old('readings')}}">
	            </div>
	        </div>

	        <div class="form-group">
	        	<input class="form-comtrol btn btn-primary pull-right" type="submit" name="">
	        </div>
		</form>
		<div>
			<h6>Please enter comma separated value in readings eg. 10,20,30,40</h6>
		</div>
	</div>
</body>
</html>