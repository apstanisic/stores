@extends('layouts.shopping')

@section('content')
	<div class="container">
		<h1 class="display-4 text-center my-4">Vasa porudzbina</h1>

		@component('partials.cart.many_items', ['products' => $cart->products])
			@slot('additional')
				<tr>
					<td colspan="4" class="text-center h4">Ukupno <strong>{{ $cart->price }}</strong> dinara.</td>
				</tr>
			@endslot
		@endcomponent



		@if(bauth($store)->user()->hasAddress())
			<div class="container">
				<form action="{{ route('buyer.orders.store', [$store->user->slug, $store->slug]) }}" method="post">
					{{ csrf_field() }}
					<div class="row mb-2">
						<div class="col text-right"><a href="{{ route('shop.addresses.create', [$store->user->slug, $store->slug]) }}">Dodajte novu adresu</a></div>
					</div>

					<div class="row">
					<label for="address" class="col-sm-4 col-md-3 col-form-label">Izaberite adresu</label>
					<select name="address_id" id="address" class="form-control col-sm-8 col-md-9">
						@foreach(bauth($store)->user()->addresses as $address)
							<option value="{{ $address->id }}">{{ $address->name }} - {{ $address->street_name }} {{ $address->building_number }}</option>
						@endforeach
					</select>
					</div>
					<div class="row mt-3">
						<button class="btn btn-primary btn-block">Naruci</button>
					</div>
				</form>
			</div>
		@else
			<p class="h4">Morate imati adresu da biste narucili proizvode. <strong><a href="{{ route('shop.addresses.create', [$store->user->slug, $store->slug]) }}">Dodajte&nbsp;adresu</a></strong>.</p>
		@endif

	</div>



@endsection