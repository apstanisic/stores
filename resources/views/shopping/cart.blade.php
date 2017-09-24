@extends('layouts.shopping')

@section('content')
	<div class="container">

		@if(count($products))

			<p class="display-4 text-center p-3">Vaša korpa</p>
			<ul class="list-unstyled">

				@include('partials.cart.many_items', ['products' => $products, 'canEdit' => true])

			</ul>
			<a href="{{ route('buyer.orders.create', [$store->user->slug, $store->slug]) }}" class="btn btn-primary btn-block btn-lg">Naruči</a>

		@else
			<p class="display-4 text-center p-3">Vaša korpa je prazna</p>
		@endif

	</div>


@endsection