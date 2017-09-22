@extends('layouts.shopping')

@section('content')
	<div class="container">
		<div class="text-center py-3">
			<a href="{{ route('shop.addresses.create', [$store->user->slug, $store->slug])}}" class="btn btn-primary px-5">Dodaj novu</a>
		</div>

		@if(count($addresses))
			@foreach($addresses as $address)
				@component('partials.addresses.small')
					@slot('address', $address)
					@slot('routes')
					<div class="d-flex">
						<a href="{{ route('shop.addresses.edit', [$store->user->slug, $store->slug, $address->slug]) }}" class="btn btn-outline-light">
							Izmeni
						</a>
						<form class="inline-form" action="{{ route('shop.addresses.destroy', [$store->user->slug, $store->slug, $address->slug]) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							<button type="submit" class="btn btn-outline-danger ml-2">Izbrisi</button>
						</form>
					</div>
					@endslot
				@endcomponent
			@endforeach
		@else
			<div class="container text-center pt-4">
				<p class="h1 m-2">Nemate nijednu adresu.</p>
			</div>
		@endif
	</div>
@endsection