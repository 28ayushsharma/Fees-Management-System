<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{config('constants.ORG_NAME')}}</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Andragogy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //custom-theme -->
	<link href="{{asset('front/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{asset('front/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- js -->
	<script type="text/javascript" src="{{asset('front/js/jquery-2.1.4.min.js')}}"></script>
	<!-- //js -->
	<!-- font-awesome-icons -->
	<link href="{{asset('front/css/font-awesome.css')}}" rel="stylesheet"> 
	<!-- //font-awesome-icons -->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700&amp;subset=latin-ext" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
	
<body>
<!-- header -->
	<div class="header_address_mail">
		<div class="container">
			<div class="agileits_header_address_grid">
				<ul>	
					<li><a href="#">Call Us</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i></li>
					<li>7737056797</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="header">
		<div class="container">
			<div class="agile_logo">
				<h1><a href="index.html"><span>M</span>odern Academy School</a></h1>
			</div>
			<div class="header-nav">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-12">
							<ul class="nav navbar-nav agile_nav">
								<li class="active"><a href="index.html"><span>Home</span></a></li>
								<li><a href="#"><span>About Us</span></a></li>
								<li><a href="#"><span>Mail Us</span></a></li>
							</ul>
							
						</nav>
					</div>
				</nav>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- header -->
<!-- banner -->
<!-- banner-slider -->
	<div class="banner-slider">
			<div class="slider">
				<div class="callbacks_container">
					<ul class="rslides callbacks callbacks1" id="slider4">
						<li>
							<div class="agileits-banner-info">
								<div class="container">
									<div class="banner-shadow">
										<h3>THE PLACE FOR HAPPY AND CREATIVE LEARNING</h3>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="agileits-banner-info agileits-banner-info1">
								<div class="container">
									<div class="banner-shadow">
										<h3>Help on your way to academic excellence!</h3>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="agileits-banner-info agileits-banner-info2">
								<div class="container">
									<div class="banner-shadow">
										<h3>THE PLACE FOR HAPPY AND CREATIVE LEARNING</h3>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
				<script src="{{asset('front/js/responsiveslides.min.js')}}"></script>
				<script>
					// You can also use "$(window).load(function() {"
					$(function () {
					  // Slideshow 4
					  $("#slider4").responsiveSlides({
						auto: true,
						pager:true,
						nav:false,
						speed: 500,
						namespace: "callbacks",
						before: function () {
						  $('.events').append("<li>before event fired.</li>");
						},
						after: function () {
						  $('.events').append("<li>after event fired.</li>");
						}
					  });
				
					});
				 </script>
				<!--banner Slider starts Here-->
			</div>
	</div>
	<!-- //banner-slider -->

<!-- services -->
	<div class="services">
		<div class="container">
			<div class="header">
				<h2>RECENT <span>PROGRAMS </span></h2>
				<p><span><i class="fa fa-book" aria-hidden="true"></i></span></p>
			</div>
			<div class="services_grids">
				<div class="col-md-6 services_grid">
					<div class="services_grid agileits_services_grid3">
						<div class="wthree_service_text">
							<h3>EDUCATION</h3>
							<h4>EDUCATIONAL RESOURCES</h4>
						</div>
					</div>
				</div>
				<div class="col-md-6 services_grid">
					<div class="services_grid agileits_services_grid4">
						<div class="wthree_service_text">
							<h3>ARTS & CULTURE</h3>
							<h4>RESOURCES, EVENTS & PROGRAMS</h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 services_grid">
					<div class="services_grid agileits_services_grid">
						<div class="wthree_service_text">
							<h3>WELLNESS </h3>
							<h4>EVENTS AND PROGRAMS</h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 services_grid">
					<div class="services_grid agileits_services_grid2">
						<div class="wthree_service_text">
							<h3>COURSES</h3>
							<h4>EVENTS AND PROGRAMS</h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 services_grid">
					<div class="services_grid agileits_services_grid1">
						<div class="wthree_service_text">
							<h3>RECREATION</h3>
							<h4>EVENTS AND PROGRAMS</h4>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //services -->
<!-- statistics -->
	<div class="statistics">
		<div class="container">
			<div class="col-md-6 statistics_grid_left">
				<div class="statistics_grid_left_grid">
					<img src="{{asset('front/images/g5.jpg')}}" alt=" " class="img-responsive" />
					
				</div>
			</div>
			<div class="col-md-6 statistics_grid_right">
				<h4>Nulla faucibus mauris ac leo imperdiet, id auctor urna consectetur</h4>
				<div class="col-md-4 stats_grid">
					<h3 id="stats1" class="odometer">0</h3>
					<p>Experience</p>
					<div class="stats_grid1">
						<i class="fa fa-calendar" aria-hidden="true"></i>
					</div>
				</div>
				<div class="col-md-4 stats_grid">
					<h3 id="stats2" class="odometer">0</h3>
					<p>Awards</p>
					<div class="stats_grid1">
						<i class="fa fa-trophy" aria-hidden="true"></i>
					</div>
				</div>
				<div class="col-md-4 stats_grid">
					<h3 id="stats3" class="odometer">0</h3>
					<p>Students</p>
					<div class="stats_grid1">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //statistics -->

<!-- odometer-script -->
	<script src="{{asset('front/js/odometer.js')}}"></script>
	<script>
		window.odometerOptions = {
		  format: '(ddd).dd'
		};
	</script>
	<script>
		setTimeout(function(){
			jQuery('#stats1').html(25);
		}, 1500);
	</script>
	<script>
		setTimeout(function(){
			jQuery('#stats2').html(330);
		}, 1500);
	</script>
	<script>
		setTimeout(function(){
			jQuery('#stats3').html(542);
		}, 1500);
	</script>
<!-- //odometer-script -->
<!-- featured-services -->
	<div class="services">
		<div class="container">
			<div class="header">
				
				<h5>PORTAL  <span>BENEFITS</span></h5>
				<p><span><i class="fa fa-book" aria-hidden="true"></i></span></p>
			</div>
			<div class="skills_grids featured_services_grids">
				<div class="col-md-6 featured_services_left">
					<div class="featured_services_left_grid">
						<div class="col-xs-4 featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-desktop"> </i>
							</div>
						</div>
						<div class="col-xs-8 featured_services_left_gridr">
							<h4>Computer Lab</h4>
							<p>Maecenas bibendum nisi purus, in ullamcorper nisl aliquam id.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="featured_services_left_grid">
						<div class="col-xs-4 featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-bullhorn"> </i>
							</div>
						</div>
						<div class="col-xs-8 featured_services_left_gridr">
							<h4>Spoken English</h4>
							<p>Maecenas bibendum nisi purus, in ullamcorper nisl aliquam id.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-6 featured_services_right">
					<img src="{{asset('front/images/3.jpg')}}" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 featured_services_right">
					<img src="{{asset('front/images/4.jpg')}}" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 featured_services_left">
					<div class="featured_services_left_grid">
						<div class="col-xs-4 featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-eye"> </i>
							</div>
						</div>
						<div class="col-xs-8 featured_services_left_gridr">
							<h4>Camera Vigilance</h4>
							<p>Camera in every class rooms.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="featured_services_left_grid">
						<div class="col-xs-4 featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-group"> </i>
							</div>
						</div>
						<div class="col-xs-8 featured_services_left_gridr">
							<h4>Highly Qualified Staff</h4>
							<p>Highly Qualified teachers and well trained staff.</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //featured-services -->
<!-- subscribe -->
	<div class="footer-top">
		<div class="container">
			<div class="col-md-5 welcome">
				<h3>{{config('constants.ORG_NAME')}}</h3>
				<p>The opportunity to help students learn and grow. Come be a part of our schools, whether as an involved parent, a student, a community volunteer, or a partner. Pulling together, we can accomplish our goal.</p>
				
			</div>
			<div class="col-md-3 address">
				<h3>Address</h3>
					<p>Guru Jambeshwar Nagar-B
						<span>Habib Marg, Gandhi Path, Queens Road, Jaipur</span>
					</p>
					<p class="phone">Phone : 7737056797
					</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<!-- //subscribe -->
<!-- copy-right -->
	<div class="copy-right-grids">
		<div class="container">
			<div class="copy-left">
				<p class="footer-gd">{{config('constants.ORG_NAME')}}</p>
			</div>
				<div class="clearfix"></div>
		</div>
	</div>
<!-- //copy-right -->
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="{{asset('front/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smooth-scrolling -->
<!-- for bootstrap working -->
	<script src="{{asset('front/js/bootstrap.js')}}"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>