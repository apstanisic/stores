@extends('layouts.base')


@section('body')
	<div class="d-flex">
	
		<div class="sidebar bg-inverse pt-2 d-inline" id="sidebar">

				<button type="button" class="btn-transparent text-lightgrey" id="sidebarToggle">
					<div class="sidebar-block">
						<div class="sidebar-icon">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</div>
						<span class="sidebar-text">Skupi navigaciju</span>
					</div>
				</button>

			{{-- <form action="{{ route('logout') }}" method="post">
				{{ csrf_field() }}
				<button type="submit" class="btn-transparent text-lightgrey">
					<div class="sidebar-block">
						<div class="sidebar-icon">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</div>
						<span class="sidebar-text">Izlogujte se</span>
					</div>
				</button>
			</form> --}}

			<a href="{{ route('stores.index') }}" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-home" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Pocetna</span>
				</div>
			</a>
		

			<a href="{{ route('stores.show', [$store->id]) }}" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-shopping-basket" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Prodavnica - "{{ $store->name }}"</span>
				</div>
			</a>


			<a href="{{ route('products.index', [$store->id]) }}" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-archive" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Proizvodi</span>
				</div>
			</a>

			<a href="{{ route('categories.index', [$store->id]) }}" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-list-alt" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Kategorije</span>
				</div>
			</a>



			<a href="{{ route('stores.edit', [$store->id]) }}" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Izmeni prodavnicu</span>
				</div>
			</a>


			<form action="{{ route('stores.destroy', [$store->id]) }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="delete">
				<button type="submit" class="btn-transparent text-lightgrey">
					<div class="sidebar-block">
						<div class="sidebar-icon">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</div>
						<span class="sidebar-text">Izbrisi prodavnicu</span>
					</div>
				</button>
			</form>	

	

			<a href="#" class="text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Profil</span>
				</div>
			</a>

			<form action="{{ route('logout') }}" method="post">
				{{ csrf_field() }}
				<button type="submit" class="btn-transparent text-lightgrey">
					<div class="sidebar-block">
						<div class="sidebar-icon">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
						</div>
						<span class="sidebar-text">Izlogujte se</span>
					</div>
				</button>
			</form>

		</div>

		<div class="content container min-250 overflow-hidden">
			@include('partials.flash')
			@yield('content')
		</div>
	</div>

@endsection