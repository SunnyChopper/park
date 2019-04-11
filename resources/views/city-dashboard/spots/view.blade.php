@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h1>City Parking Spots</h1>
			<hr />
			@if(count($spots) > 0)
			<a href="/city/parkings/new" class="btn btn-primary">Create New Parking Spot</a>
			@endif
		</div>
	</div>

	<div class="row" style="margin-top: 32px;">
		<div class="col-12">
			@if(count($spots) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Spot Number</th>
								<th>Zone Name</th>
								<th>Amount per Hour</th>
								<th>Dynamic Pricing</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($spots as $spot)
								<tr>
									<td>{{ $spot->spot_number }}</td>
									<td>{{ App\Zone::find($spot->zone_id)->title }}</td>
									<td>${{ sprintf("%.2f", $spot->amount_per_hour) }}</td>
									@if($spot->dynamic_pricing == 1)
										<td>Enabled</td>
									@else
										<td>Disabled</td>
									@endif

									@if($spot->status == 0)
									<td><h4><span class="badge badge-primary">Open</span></h4></td>
									@elseif($spot->status == 1)
									<td><h4><span class="badge badge-success">Active</span></h4></td>
									@elseif($spot->status == 2)
									<td><h4><span class="badge badge-warning">Waiting</span></h4></td>
									@elseif($spot->status == 3)
									<td><h4><span class="badge badge-danger">Unauthorized</span></h4>
									@endif

									
									<td>
										<a href="/city/spots/edit/{{ $spot->id }}" class="btn btn-warning" style="float: right;">Edit</a>
										<a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={%22city_id%22:{{ $city->id }},%22spot_id%22:{{ $spot->id }},%22amount_per_hour%22:{{ $spot->amount_per_hour }}}" target="_blank" class="btn btn-primary mr-2" style="float: right;">Generate QR</a>
									</td>
									
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<h4 class="text-center" style="margin-top: 32px;">No Parking Spots</h4>
				<p class="text-center">There were no parking spots in the database for your city. Click below to create one.</p>
				<a href="/city/spots/new" class="btn btn-primary centered">Create New Parking Spot</a>
			@endif
		</div>
	</div>
@endsection