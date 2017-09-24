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
			<h2 class="h1 text-center my-4">Vaše prodavnice</h2>
			<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-default">
					<tr>
						<th colspan="5" class="text-center">
							<a href="{{ route('stores.create') }}">Napravi prodavnicu</a>
						</th>
					</tr>
					<tr>
						<th class="w-50p">#</th>
						<th class="text-center">Prodavnica</th>
						<th class="text-center w-100p">Proizvodi</th>
						{{-- <th class="text-center">Kategorije</th> --}}
						<th class="text-center w-100p">Izmeni</th>
						<th class="text-center w-100p">Poseti</th>
					</tr>
				</thead>
				<tbody>
					@foreach($stores as $store)
						<tr>
							<td>{{ $i++ }}</td>

							<td class="text-center h3"><a href="{{ route('stores.show', [$store->slug]) }}">{{ $store->name }}</a></td>

							<td class="text-center">
								<a href="{{ route('stores.products.index', [$store->slug]) }}" class="btn btn-primary">
									<i class="fa fa-archive" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<a href="{{ route('stores.edit', [$store->slug]) }}" class="btn btn-primary">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<a href="{{ route('shopping.index', [$store->user->slug, $store->slug]) }}" class="btn btn-info">
									<i class="fa fa-globe" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	@endif

@endsection

