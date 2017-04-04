@extends('layouts.master')


@php
	// Sluzi kao inkrement za redni broj radnje
	$i = 1;
@endphp

@section('content')

	@if(!empty($stores))
		
		<h2 class="h1 text-center my-3">Vase prodavnice</h2>

		<table class="table table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>#</th>
					<th>Prodavnica</th>
					<th class="text-center">Proizvodi</th>
					<th class="text-center">Izmeni</th>
					<th class="text-center">Izbrisi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($stores as $store)
					<tr>
						<td>{{ $i++ }}</td>

						<td><a href="{{ route('stores.show', [$store->id]) }}">{{ $store->name }}</a></td>

						<td class="text-center">
							<a href="{{ route('products.index', [$store->id]) }}" class="btn btn-primary">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
						</td>

						<td class="text-center">
							<a href="{{ route('stores.edit', [$store->id]) }}" class="btn btn-warning">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>
						</td>

						<td class="text-center">
							<form method="post" action="{{ route('stores.destroy', [$store->id]) }}" >
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="btn btn-danger">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</button>
							</form>
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>

	@endif

@endsection