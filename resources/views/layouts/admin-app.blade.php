<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/fonts/circular-std/style.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('libs/css/style.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/fonts/fontawesome/css/fontawesome-all.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/charts/chartist-bundle/chartist.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/charts/morris-bundle/morris.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/charts/c3charts/c3.css?v=2') }}">
	    <link rel="stylesheet" href="{{ URL::asset('vendor/fonts/flag-icon-css/flag-icon.min.css?v=2') }}">

	    @if(isset($page_title))
	    	<title>{{ config('app.name') }} - {{ $page_title }}</title>
	    @else
	    	<title>{{ config('app.name') }}</title>
	    @endif
	</head>
	<body>
		<div class="dashboard-main-wrapper">
			@include('layouts.admin-header')
			@include('layouts.admin-sidebar')
			<div class="dashboard-wrapper">
            	<div class="dashboard-ecommerce">
            		<div class="container-fluid dashboard-content">
            			@yield('content')
            		</div>
            	</div>

            	@include('layouts.admin-footer')
            </div>
		</div>

		@include('layouts.admin-js')
	</body>
</html>