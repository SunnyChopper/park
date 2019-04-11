@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h2>Create New Zone</h2>
			<hr />
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-lg-7 col-md-8 col-sm-12 col-12">
			<div class="card">
				<div class="card-text" style="padding: 24px;">
					<form action="/city/zones/create" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="city_id" value="{{ $city->id }}">
						<input type="hidden" name="city" value="{{ $city->city }}">
						<input type="hidden" name="state" value="{{ $city->state }}">

						<div class="form-group row">
							<div class="col-12">
								<label>Title:</label>
								<input type="text" name="title" class="form-control" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<label>Street Address:</label>
								<input type="text" name="address" class="form-control" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-5 col-md-5 col-sm-12 col-12">
								<label>City:</label>
								<input type="text" name="city" class="form-control" required>
							</div>

							<div class="col-lg-5 col-md-5 col-sm-12 col-12">
								<label>State:</label>
								<input type="text" name="state" class="form-control" required>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-12 col-12">
								<label>Zipcode:</label>
								<input type="text" name="zipcode" class="form-control" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<input type="submit" value="Create Zone" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection