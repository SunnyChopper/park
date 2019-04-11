@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h1>City Zones</h1>
			<hr />
			@if(count($zones) > 0)
			<a href="/city/zones/new" class="btn btn-primary">Create New Zone</a>
			@endif
		</div>
	</div>

	<div class="row" style="margin-top: 32px;">
		<div class="col-12">
			@if(count($zones) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Zone Name</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($zones as $zone)
								<tr>
									<td>{{ $zone->title }}</td>
									<td>{{ sprintf("%.4f", $zone->latitude) }}</td>
									<td>{{ sprintf("%.4f", $zone->longitude) }}</td>
									<td><a href="/city/zones/edit/{{ $zone->id }}" class="btn btn-warning" style="float: right;">Edit</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<h4 class="text-center" style="margin-top: 32px;">No Parking Zones</h4>
				<p class="text-center">There were no parking zones in the database for your city. Click below to create one.</p>
				<a href="/city/zones/new" class="btn btn-primary centered">Create New Zone</a>
			@endif
		</div>
	</div>
@endsection