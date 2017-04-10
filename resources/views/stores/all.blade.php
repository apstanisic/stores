@extends('layouts.master')


@php
	$i = 1; // Sluzi kao inkrement za redni broj radnje
@endphp

@section('content')
	@if(!count($stores))
		<div class="h1 text-center my-5">
			<h2>Nemate nijednu prodavnicu</h2>
			<a href="{{ route('stores.create') }}" class="">Napravite prodavnicu</a>
		</div>
	@else
		<div class="container">
			<h2 class="h1 text-center my-4">Vase prodavnice</h2>
			<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-default">
					<tr>
						<th colspan="3" class="text-center">
							<a href="{{ route('stores.create') }}">Napravi prodavnicu</a>
						</th>
					</tr>
					<tr>
						<th class="w-50p">#</th>
						<th class="text-center">Prodavnica</th>
						<th class="text-center w-100p">Proizvodi</th>
						{{-- <th class="text-center">Kategorije</th> --}}
						{{-- <th class="text-center w-100p">Izbrisi</th> --}}
					</tr>
				</thead>
				<tbody>
					@foreach($stores as $store)
						<tr>
							<td>{{ $i++ }}</td>

							<td class="text-center h3"><a href="{{ route('stores.show', [$store->id]) }}">{{ $store->name }}</a></td>

							<td class="text-center">
								<a href="{{ route('products.index', [$store->id]) }}" class="btn btn-primary">
									<i class="fa fa-archive" aria-hidden="true"></i>
								</a>
							</td>

							{{-- <td class="text-center">
								<a href="{{ route('stores.edit', [$store->id]) }}" class="btn btn-primary">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</td> --}}
{{-- 
							<td class="text-center">
								<form method="post" action="{{ route('stores.destroy', [$store->id]) }}" >
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="delete">
									<button type="submit" class="btn btn-danger">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</form>
							</td> --}}

						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	@endif

@endsection

