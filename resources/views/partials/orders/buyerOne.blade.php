@component('partials.orders.big', ['products' => $order->products])
	@slot('status')
		{{ $order->status->name }}
	@endslot
	@slot('id')
		{{ $order->slug }}
	@endslot
	@slot('description')
		{{ $order->status->description }}
	@endslot
	@slot('price')
		{{ $order->price }}
	@endslot
	@slot('created_at')
		{{ $order->created_at->diffForHumans() }}
	@endslot
	@slot('links')
		<a href="{{ route('buyer.orders.edit', [$order->store->slug, $order->slug]) }}" class="btn btn-warning">Izmeni porudzbinu</a>
	@endslot
@endcomponent