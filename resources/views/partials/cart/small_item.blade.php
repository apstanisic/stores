<div class="media my-2 border-1 p-3 container">
	<div class="container">
		<div class="row">

			<div class="col-12 col-sm-6 col-md-6 d-flex">
				<img class="d-flex align-self-center mr-3" src="{{ $product->images()->first() ?? 'https://placehold.it/50x50' }}" alt="">
				<div class="media-body">
					<a href="{{ route('shopping.products.show', [$product->store->user->slug, $product->store->slug, $product->slug]) }}">
						<h5 class="mt-0">{{ $product->name }}</h5>
					</a>
				</div>
			</div>

			<div class="col-6 col-sm-3">
				<div class="mx-4">
					{{ $product->price * $product->pivot->amount }} din.
				</div>
			</div>

			<div class="col-6 col-sm-3">
				<div>
					<form action="{{ route('cart.store', [$product->store->user->slug, $product->store->slug, $product->slug]) }}" method="post" class="form-inline">
						{{ csrf_field() }}
						<select name="amount" class="custom-select">

							@for($i = 1; $i <= 20; $i++)
								<option value="{{ $i }}" {{ ($i === $product->pivot->amount) ? 'selected' : '' }}>{{ $i }}</option>
							@endfor

						</select>
						<button type="submit" class="btn btn-warning ml-2">Izmeni</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>