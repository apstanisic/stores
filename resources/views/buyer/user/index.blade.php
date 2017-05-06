@extends('layouts.master')


@section('content')

<h1 class="display-4 text-center mt-3">Vas profil</h1>

<div class="container">
	<div class="row">
		<div class="col-sm my-2">
			<div class="card">
				<div class="card-header">
					<p class="text-center mb-0 h5">O vama</p>
				</div>
				<div class="card-block py-0">
					<ul class="list-group list-group-flush">
						<li class="list-group-item mx-auto">{{ $user->username }}</li>
						<li class="list-group-item mx-auto">{{ $user->email }}</li>
						<li class="list-group-item mx-auto">
							<a href="{{ route('user.edit') }}" class="btn btn-primary">Izmenite profil</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm my-2">
			<div class="card">
				<div class="card-header">
					<p class="text-center mb-0 h5">Prodavnice</p>
				</div>
				<div class="card-block py-0">
					<ul class="list-group list-group-flush">
						@if(count($user->stores))
							@foreach($user->stores as $store)
								<li class="list-group-item mx-auto">
									<a href="{{ route('stores.show', [$store->id]) }}">{{ $store->name }}</a>
								</li>
							@endforeach
						@else
							<li class="list-group-item mx-auto">Nemate nijednu prodavnicu</li>
						@endif
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm my-2">
			<div class="card">
				<div class="card-header">
					<p class="text-center mb-0 h5">Statistika</p>
				</div>
				<div class="card-block py-0">
					<ul class="list-group list-group-flush">
						<li class="list-group-item mx-auto">{{ count($user->stores) }} prodavnica/e</li>
						<li class="list-group-item mx-auto">{{ $user->productsCount() }} proizvod/a</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection