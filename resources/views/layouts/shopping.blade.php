@extends('layouts.base')

@push('stylesheet')
	<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endpush

@section('body')
	@component('layouts.partials.header', compact('paramLinks'))
		@slot('right')

				{{-- Ako je ulogovan mora da ima manji margin bottom zbog dropdown liste --}}
				<a href="{{ route('cart.index', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1 {{ ($BAuth::check()) ? ' mb-4 mb-md-1' : '' }}" >Cart</a>
			 	@if($BAuth::check())

					<span class="nav-item dropdown">
						<button class="dropdown-toggle btn btn-outline-secondary my-3 my-md-0 mx-1" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ $BAuth::buyer()->username }}
						</button>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a href="{{ route('buyer.index', [$user->id, $store->id]) }}" class="dropdown-item h5">
					 			{{-- {{ $BAuth::buyer()->username }} --}}
					 			Profile
					 		</a>
					 		<a href="{{ route('buyer.orders.index', [$store->user->id, $user->id]) }}" class="dropdown-item h5">Orders</a>
							<form action="{{ route('buyer.logout', [$user->id, $store->id]) }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class=" {{-- btn-outline-secondary --}} dropdown-item h5 mb-0">Logout</button>
							</form>
						</div>
					</span>
				{{-- Stari izgled, svako dugme je za sebe. nema dropdown --}}
			 	{{-- 	<a href="{{ route('buyer.index', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1">
			 			{{ $BAuth::buyer()->username }}
			 		</a>
					<form action="{{ route('buyer.logout', [$user->id, $store->id]) }}" method="post">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Logout</button>
					</form> --}}
		 		@else
					<a href="{{ route('buyer.login', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Login</a>
			      	<a href="{{ route('buyer.register.show', [$user->id, $store->id]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Sign Up</a>
		      	@endif

		@endslot
	@endcomponent

	<div class="content">
		@include('partials.flash')
		@yield('content')
	</div>

	@include('layouts.partials.footer')
@endsection

