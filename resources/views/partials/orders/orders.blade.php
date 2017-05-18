@php
	$i = 1;
@endphp
<h1 class="text-center m-4">Porudzbine</h1>
@foreach($orders as $order)
	<div class="card m-3">
		<div class="card-header card-inverse card-@include('partials.status_color') text-white">
		{{ $order->status->description }}
		</div>
		<div class="card-block">
			<h4 class="card-title">{{ $i++ . '. ' . $order->created_at->diffForHumans() }}</h4>
			<p>Cena je: <strong>{{ $order->price }} dinara</strong>, i sadrzi {{ count($order->products) }} proizvod/a.</p>
			<a href="{{ route('stores.orders.show', [$store->slug, $order->slug]) }}" class="btn btn-primary">Detaljnije</a>
			<a href="{{ route('stores.orders.edit', [$store->slug, $order->slug]) }}" class="btn btn-primary">Izmeni</a>
		</div>
	</div>
@endforeach
