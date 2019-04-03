<footer id="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 footer-info">
					<img src="img/logo.png" alt="TheEvenet">
					<p>Our mission is to create the parking experience as seamless and effortless as possible.</p>
				</div>

				<div class="col-lg-3 col-md-6 footer-links">
					<h4>Useful Links</h4>
					<ul>
						@if(Auth::guest())
						<li><i class="fa fa-angle-right"></i> <a href="#">Login</a></li>
						<li><i class="fa fa-angle-right"></i> <a href="#">Register</a></li>
						@endif
					</ul>
				</div>

				<div class="col-lg-3 col-md-6 footer-links">
					<h4>Legal</h4>
					<ul>
						<li><i class="fa fa-angle-right"></i> <a href="#">Careers</a></li>
						<li><i class="fa fa-angle-right"></i> <a href="#">Terms of Service</a></li>
						<li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
					</ul>
				</div>

				<div class="col-lg-3 col-md-6 footer-contact">
					<h4>Contact Us</h4>
					<p>701 S Franklin Ave <br>
					Normal, IL 61761<br>
					United States <br>
					<strong>Phone:</strong> +1 217 419 4494<br>
					<strong>Email:</strong> info@iparkapp.com<br>
					</p>

					<div class="social-links">
						<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
						<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
						<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
						<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="copyright">
		&copy; Copyright <strong>iPark App</strong>. All Rights Reserved
		</div>
		<div class="credits">
			<!--
			All the links in the footer should remain intact.
			You can delete the links only if you purchased the pro version.
			Licensing information: https://bootstrapmade.com/license/
			Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
			-->
			Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
		</div>
	</div>
</footer>