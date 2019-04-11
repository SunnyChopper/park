@extends('layouts.app')

@section('content')
	<div class="container pt-128 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">Register City</h2>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<form action="/city/register/create" method="POST">
					{{ csrf_field() }}
					<div class="form-group row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>City:</label>
							<input type="text" name="city" class="form-control" required>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>State:</label>
							<input type="text" name="state" class="form-control" required>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>Zipcode:</label>
							<input type="text" name="zipcode" class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<label>Email:</label>
						<input type="email" name="email" class="form-control" required>
					</div>

					<div class="form-group row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Username:</label>
							<input type="text" name="username" class="form-control" required>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Password:</label>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Create Account">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection