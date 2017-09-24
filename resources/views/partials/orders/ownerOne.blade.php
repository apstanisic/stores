@component('partials.orders.big', ['products' => $order->products, 'owner' => true])
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
		<a href="{{ route('stores.orders.edit', [$order->store->slug, $order->slug]) }}" class="btn btn-warning">Izmeni porudžbinu</a>
	@endslot
@endcomponent