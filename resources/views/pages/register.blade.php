@extends('layouts.app')

@section('content')
	<div class="container pt-128 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<form action="/users/create" method="POST">
					{{ csrf_field() }}
					<div class="gray-box">
						<h3 class="text-center">Register Account</h3>
						<hr />
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>First Name:</label>
								<input type="text" name="first_name" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Last Name:</label>
								<input type="text" name="last_name" class="form-control" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Username:</label>
								<input type="text" name="username" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Email:</label>
								<input type="email" name="email" class="form-control" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<label>Password:</label>
								<input type="password" name="password" class="form-control" required>
							</div>
						</div>

						@if(session()->has('error'))
						<div class="form-group">
							<p class="mb-0 text-center red">{{ session()->get('error') }}</p>
						</div>
						@endif

						<div class="form-group">
							<input type="submit" value="Create Account" class="btn btn-primary centered">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection