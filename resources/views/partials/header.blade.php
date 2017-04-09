<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="{{ url('/') }}">Navbar</a>

	<div class="collapse navbar-collapse text-center" id="navbarTogglerDemo02">
		{{-- Uraditi dinamicki --}}
		<ul class="navbar-nav mr-auto mt-2 mt-md-0">
			<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
				<a class="nav-link" href="{{ url('/zasto_mi') }}">Zasto mi</a>
			</li>
			<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
				<a class="nav-link" href="{{ url('/korisnici') }}">Nasi korisnici</a>
			</li>
			<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
				<a class="nav-link" href="{{ url('/upustva') }}">Upustva</a>
			</li>
			<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
				<a class="nav-link" href="{{ url('/kontakt') }}">Kontakt</a>
			</li>
			<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
				<a class="nav-link" href="{{ url('/cenovnik') }}">Cenovnik</a>
			</li>
		</ul>
		{{-- @end --}}
	
		<div>
		 	@if (Auth::check())
				<form action="{{ route('logout') }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Logout</button>
				</form>
	 		@else
				<a href="{{ url('/login') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Login</a>
		      	<a href="{{ url('/register') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Sign Up</a>
	      	@endif
		</div>
	</div>

</nav>