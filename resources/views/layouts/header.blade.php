<header id="header" class="header-fixed">
	<div class="container">
		<div id="logo" class="pull-left">
			<!-- Uncomment below if you prefer to use a text logo -->
			<!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
			<a href="#intro" class="scrollto"><img src="{{ URL::asset('img/logo.png') }}" alt="iPark Logo" title="iPark Logo"></a>
		</div>

		<nav id="nav-menu-container">
			@if(App\Custom\UserAccountHelper::is_user_logged_in() == false)
			<ul class="nav-menu">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li><a href="{{ url('/how-it-works') }}">How It Works</a></li>
				<li><a href="">For Cities</a></li>
				<li><a href="">For Citizens</a></li>
				<li><a href="{{ url('/login') }}">Login</a></li>
				<li class="buy-tickets"><a href="{{ url('/register') }}">Create Account</a></li>
			</ul>
			@elseif(App\Custom\UserAccountHelper::is_user_logged_in() == true)
			<ul class="nav-menu">
				<li><a href="{{ url('/members/dashboard') }}">Dashboard</a></li>
				<li><a href="{{ url('/members/vehicles') }}">Your Vehicles</a></li>
				<li><a href="{{ url('/members/history') }}">Parking History</a></li>
				<li><a href="{{ url('/members/payments') }}">Billing</a></li>
				<li class="buy-tickets"><a href="{{ url('/members/logout') }}">Logout</a></li>
			</ul>
			@endif
		</nav>
	</div>
</header>