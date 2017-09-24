<div class="border-1 p-1 p-sm-3 mb-4">
	<p class="h4 text-center">Dodaj kolicinu za koju hoćete da izmenite stanje</p>
 	<p class="text-center">(Dodajte minus ako hoćete da umanjite stanje)</p>
	<form action="{{ route('stores.products.remaining', [$product->store->slug, $product->slug]) }}" class="conteiner my-3" method="post">
		{{ method_field('patch') }}
		{{ csrf_field() }}
		<div class="row">
			<div class="col-6 col-sm-8 col-lg-10">
				<input type="number" name="remaining" class="form-control">
			</div>
			<div class="col-6 col-sm-4 col-lg-2">
				<button class="btn btn-primary btn-block">Izmeni</button>
			</div>
		</div>
	</form>
</div>