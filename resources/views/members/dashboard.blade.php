@extends('layouts.app')

@section('content')
	<div class="container pt-128 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">Welcome {{ $user->first_name }} {{ $user->last_name }}</h2>
				<hr />
			</div>
		</div>

		<div class="row mt-16">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<h5>Parking History Summary</h5>
				@if(count($parking_sessions) > 0)
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Date</th>
									<th>Vehicle</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								@foreach($parking_sessions as $session)
								<?php $vehicle = App\Custom\VehicleHelper::get_vehicle_data($session->vehicle_id); ?>
								<tr>
									<td>{{ $session->created_at->format('M jS, Y') }}</td>
									<td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
									<td>${{ sprintf("%.2f", $session->amount) }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<a href="/members/history" class="btn btn-primary centered">View Full History</a>
				@else
					<div class="gray-box">
						<p class="text-center mb-2"><strong>No parking sessions found.</strong></p>
						<p class="text-center mb-0">Use our mobile application to start parking.</p>
					</div>
				@endif
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<h5>Your Vehicles</h5>
				@if(count($vehicles) > 0)
				@else
					<div class="gray-box">
						<p class="text-center mb-2"><strong>No vehicles added.</strong></p>
						<p class="text-center mb-2">Click below to add your first vehicle.</p>
						<a href="/members/vehicles/add" class="btn btn-primary centered">Add Vehicle</a>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div style="background-color: #EEEEEE;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<h3>Parkings Near You</h3>
			</div>

			<div class="row" id="parking_cells">
				<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else {
				$("#parking_cells").html('<p>Geolocation not supported by your browser.');
			}
		}

		function showPosition(position) {
			console.log("Latitude: " + position.coords.latitude);
			console.log("Longitude: " + position.coords.longitude);
		}

		$(document).ready(function() {
			getLocation();
		});
	</script>
@endsection