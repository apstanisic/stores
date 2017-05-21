<form action="{{ route('stores.orders.update', [$store->slug, $order->slug]) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<ul class="list-group list-group-flush">
		{{-- Dodati jos proizvoda u porudzbinu --}}
		{{-- <li class="list-group-item bg-primary"><a href="#" class="text-white">Dodaj proizvod</a></li> --}}
		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>

		@foreach($order->products as $product)
		<li class="list-group-item h5">{{ $product->name }}<span class="ml-auto"><input type="number" name="{{ $product->slug }}" min="0" max="100" class="form-control" value="{{ $product->pivot->amount }}"></span></li>
		@endforeach
	</ul>
	<div class="card-block">
		<button type="submit" class="btn btn-warning btn-block">Izmeni narudzbinu</button>
	</div>
</form>