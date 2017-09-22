@extends('layouts.dashboard')

@section('content')
	@component('partials.orders.big')
		@slot('status', $order->status->name)
		@slot('id', $order->slug)
		@slot('description', $order->status->description)
		@slot('price', $order->price)
		@slot('created_at', $order->created_at->diffForHumans())
		@slot('editProducts')
			@include('orders.form_amount')
		@endslot
		@slot('links')

			@include('orders.form_status')

	  		<form action="{{ route('stores.orders.destroy', [$order->store->slug, $order->slug]) }}" method="post" class="text-right mt-3">
	  			{{ csrf_field() }}
	  			{{ method_field('delete') }}
	  			<button class="btn btn-danger">Izbrisi porudzbinu</button>
	  		</form>

		@endslot
	@endcomponent
@endsection