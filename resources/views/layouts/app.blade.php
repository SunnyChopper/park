<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		@if(isset($page_title))
		<title>iPark - {{ $page_title }}</title>
		@else
		<title>iPark - Parking Management for Cities</title>
		@endif
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="" name="keywords">
		<meta content="" name="description">

		<!-- Favicons -->
		<link href="{{ URL::asset('img/favicon.png') }}" rel="icon">
		<link href="{{ URL::asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

		<!-- Bootstrap CSS File -->
		<link href="{{ URL::asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

		<!-- Libraries CSS Files -->
		<link href="{{ URL::asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('lib/animate/animate.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('lib/venobox/venobox.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

		<!-- Main Stylesheet File -->
		<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/layouts.css') }}" rel="stylesheet">
	</head>
	<body>
		@include('layouts.header')
		<main id="main">
			@yield('content')
		</main>
		@include('layouts.footer')
		@include('layouts.js')
	</body>
</html>