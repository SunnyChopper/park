@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h1>City Dashboard</h1>
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Employee Accounts</h4>
					<p class="card-text">View, edit, and create new employee accounts.</p>
					<a href="{{ url('/city/employees') }}" class="btn btn-primary">View Accounts</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Zones</h4>
					<p class="card-text">View, edit, and create new parking zones.</p>
					<a href="{{ url('/city/zones') }}" class="btn btn-primary">View Zones</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Parking Spots</h4>
					<p class="card-text">View, monitor, edit, and create new parking spots.</p>
					<a href="{{ url('/city/parkings') }}" class="btn btn-primary">View Parking Spots</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Revenue</h4>
					<p class="card-text">View financial information for the city.</p>
					<a href="{{ url('/city/revenue') }}" class="btn btn-primary">View Revenue</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<h3>Number of Parkings per Day</h3>
			<div id="area-chart" style="width: 100%;"></div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		
		var data = [
			{ y: '2019-04-01', a: 50},
			{ y: '2019-04-02', a: 65},
			{ y: '2019-04-03', a: 50},
			{ y: '2019-04-04', a: 75},
			{ y: '2019-04-05', a: 80},
			{ y: '2019-04-06', a: 90},
			{ y: '2019-04-07', a: 100},
			{ y: '2019-04-08', a: 115},
			{ y: '2019-04-09', a: 120},
			{ y: '2019-04-10', a: 145},
			{ y: '2019-04-11', a: 160}
		],
		config = {
			data: data,
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Number of Parkings'],
			fillOpacity: 0.6,
			hideHover: 'auto',
			behaveLikeLine: true,
			resize: true,
			pointFillColors:['#ffffff'],
			pointStrokeColors: ['black'],
			lineColors:['#f82249']
		};
		config.element = 'area-chart';
		Morris.Area(config);

	</script>
@endsection