<table class="table table-hover">
	<thead class="thead-default">
		<tr>
			{{-- <th class="w-50p">#</th> --}}
			{{-- <th class="text-center w-100p">Slika</th> --}}
			<th class="text-left" colspan="2"><span class="ml-3">Proizvod</span></th>
			<th class="text-center w-100p">Cena</th>
			{{-- <th class="text-center">Kategorije</th> --}}
			<th class="text-right"><span class="mr-3">Kolicina</span></th>
		</tr>
	</thead>
	<tbody>
		@if(count($products))
			@foreach($products as $product)
				<tr>
					<td class="align-middle w-50p">
						<img class="d-flex align-self-center" src="{{ $product->images()->first() ?? 'https://placehold.it/50x50' }}" alt="">
					</td>
					<td class="text-left h3 align-middle">
						<a href="{{ route('shopping.products.show', [$store->user->slug, $store->slug, $product->slug]) }}">{{ $product->name }}</a>
					</td>

					<td class="text-center align-middle">
						{{ $product->pivot->amount * $product->price }} din.
					</td>

					<td class="text-center align-middle">
						{{-- {{ $product->pivot->amount }} --}}
						@if($canEdit ?? false)
						<form action="{{ route('cart.store', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" method="post" class="form-inline d-flex justify-content-end ml-auto">
							{{ csrf_field() }}
							<input type="number" class="form-control" name="amount" min="0" max="100" value="{{ $product->pivot->amount }}">
							<button type="submit" class="btn btn-warning ml-2">Izmeni</button>
						</form>
						@else
							<span class="d-flex justify-content-end mr-3">{{ $product->pivot->amount }}</span>
						@endif
					</td>
				</tr>
			@endforeach
		@endif
		{{ $additional or '' }}
	</tbody>
</table>