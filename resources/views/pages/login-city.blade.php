@extends('layouts.app')

@section('content')
	<div class="container pt-128 pb-64">
		<div class="row">
			<div class="col-12">
				<h3 class="text-center">City Login</h3>
				<hr />
			</div>
		</div>

		<div class="row justify-content-center mt-32">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<form action="/city/login/attempt" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" required>
					</div>

					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="password" class="form-control" required>
					</div>

					@if(session()->has('error'))
					<div class="form-group">
						<p class="text-center red mb-0">{{ session()->get('error') }}</p>
					</div>
					@endif

					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-primary centered">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection