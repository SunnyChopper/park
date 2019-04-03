@extends('layouts.app')

@section('content')
	@include('layouts.main-banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center mb-64">How We Can Help You</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<p class="text-center mb-3"><span style="font-size: 64px;"><i class="fa fa-clock-o"></i></span></p>
				<h4 class="text-center">Saving You Time</h4>
				<p class="text-center">Parking your vehicle shouldn't take more than 30 seconds. That's why we designed our experience to have you parked and ready to go in under 30 seconds!</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<p class="text-center mb-3"><span style="font-size: 64px;"><i class="fa fa-lightbulb-o"></i></span></p>
				<h4 class="text-center">Saving You Energy</h4>
				<p class="text-center">Stop wasting energy trying to find quarters or figuring out what parking number you're in. Just scan the QR code and we'll take care of the rest for you.</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<p class="text-center mb-3"><span style="font-size: 64px;"><i class="fa fa-money"></i></span></p>
				<h4 class="text-center">Saving You Money</h4>
				<p class="text-center">Parking is expensive and sometimes you're forced to buy a minimum amount of parking. With us, you save money by paying only for the minutes you use!</p>
			</div>
		</div>
	</div>

	<div style="background-color: #040913;">
		<div class="container pt-64 pb-64">
			<div class="row" style="display: flex;">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12" style="margin: auto;">
					<div class="videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/OPk1mLa3644" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-12" style="margin: auto;">
					<h3 style="color: white;">Making Parking Easier</h3>
					<p style="color: white;">All you have to do is setup an account, add your vehicles and you're ready to go. Park at any of our designated spots and enjoy the iPark experience. Pay for only the minutes that you use.</p>
					<a href="/register" class="btn btn-primary">Setup Account <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center mb-64">What Others Are Saying</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://lyrictheatreokc.com/wp-content/uploads/2015/09/Geno-Square-Headshot.jpeg" class="regular-image-50 centered mb-4" style="border-radius: 100%;">
				<h4 class="text-center"><strong>Geno A.</strong></h4>
				<p class="text-center">"Getting to class is so much easier now. Just scan the QR code and everything is taken care of for you!"</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://ninaparkerstudios.com/wp-content/uploads/2018/07/LanceHuff-Headshot-Atlanta-NinaParkerStudios-9879-SQUARE-800x800.jpg" class="regular-image-50 centered mb-4" style="border-radius: 100%;">
				<h4 class="text-center"><strong>Parker H.</strong></h4>
				<p class="text-center">"I used to have to overspend on parking for work but now I'm saving money that I can use for food."</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://acceleprise.vc/wp-content/uploads/2017/12/Rohit-Bhargava-headshot-square.png" class="regular-image-50 centered mb-4" style="border-radius: 100%;">
				<h4 class="text-center"><strong>Rohit B.</strong></h4>
				<p class="text-center">"Finding a parking spot in the city has never been this easy. Save so much time thanks to this app."</p>
			</div>
		</div>
	</div>
@endsection