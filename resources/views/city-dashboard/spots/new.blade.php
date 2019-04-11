@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h2>Create Parking Spot</h2>
			<hr />
		</div>
	</div>

	<div class="row justify-content-center mt-32">
		<div class="col-lg-7 col-md-8 col-sm-12 col-12">
			<div class="card p-32">
				@if(count($zones) == 0)
					<h4 class="text-center">No Parking Zones Found</h4>
					<p class="text-center">Before you can create parking spots, your city must add parking zones. Click below to create a new parking zone.</p>
					<a href="/city/zones/new" class="btn btn-primary centered">Create New Zone</a>
				@else
					<form action="/city/parkings/create" method="POST" id="create_spot_form">
						{{ csrf_field() }}
						<input type="hidden" name="city_id" value="{{ $city->id }}">
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Spot Number:</label>
								<input type="number" name="spot_number" min="1" step="1" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Zone:</label>
								<select class="form-control" name="zone_id" form="create_spot_form">
									@foreach($zones as $zone)
										<option value="{{ $zone->id }}">{{ $zone->title }} - ID: {{ $zone->id }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Amount per Hour:</label>
								<input type="number" name="amount_per_hour" min="0.01" step="0.01" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Dynamic Pricing:</label>
								<select class="form-control" name="dynamic_pricing" form="create_spot_form">
									<option value="0">Disabled</option>
									<option value="1">Enabled</option>
								</select>
							</div>
						</div>

						<div class="form-group row mt-16">
							<div class="col-12">
								<input type="submit" value="Create Parking Spot" class="btn btn-primary centered">
							</div>
						</div>
					</form>
				@endif
			</div>
		</div>
	</div>
@endsection