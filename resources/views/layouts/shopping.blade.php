@extends('layouts.base')

@push('stylesheet')
	<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endpush

@section('body')
	@component('layouts.partials.header', compact('paramLinks'))
		@slot('right')

				{{-- Ako je ulogovan mora da ima manji margin bottom zbog dropdown liste --}}
				<a href="{{ route('cart.index', [$store->user->slug, $store->slug]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1 {{ (bauth($store)->check()) ? ' mb-4 mb-md-1' : '' }}" >Korpa</a>
			 	@if(bauth($store)->check())

					<span class="nav-item dropdown">
						<button class="dropdown-toggle btn btn-outline-secondary my-3 my-md-0 mx-1" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ bauth($store)->user()->username }}
						</button>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a href="{{ route('buyer.index', [$store->user->slug, $store->slug]) }}" class="dropdown-item h5">
					 			Profil
					 		</a>
					 		<a href="{{ route('buyer.orders.index', [$store->user->slug, $store->slug]) }}" class="dropdown-item h5">Porudžbine</a>
							<form action="{{ route('buyer.logout', [$store->user->slug, $store->slug]) }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class=" {{-- btn-outline-secondary --}} dropdown-item h5 mb-0">Izloguj se</button>
							</form>
						</div>
					</span>
		 		@else
					<a href="{{ route('buyer.login', [$store->user->slug, $store->slug]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Uloguj se</a>
			      	<a href="{{ route('buyer.register.show', [$store->user->slug, $store->slug]) }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Napravi nalog</a>
		      	@endif

		@endslot
	@endcomponent

	<div class="content">
		<div class="container">
			@include('partials.flash')
		</div>
		@yield('content')
	</div>

	@include('layouts.partials.footer')
@endsection

