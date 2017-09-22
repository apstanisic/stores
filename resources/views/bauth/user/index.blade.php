@extends('layouts.shopping')


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
						<li class="list-group-item mx-auto">{{ $buyer->username }}</li>
						<li class="list-group-item mx-auto">{{ $buyer->email }}</li>
						{{--  <li class="list-group-item mx-auto">
							<a href="{{ route('user.edit') }}" class="btn btn-primary">Izmenite profil</a>
						</li>  --}}
						<li class="list-group-item mx-auto">
							<a href="{{ route('shop.addresses.index', [$store->user->slug, $store->slug]) }}" class="btn btn-primary">Vase adrese</a>
						</li>
					</ul>
				</div>
			</div>
		</div>



	</div>
</div>

@endsection