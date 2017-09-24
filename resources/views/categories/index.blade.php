@extends('layouts.dashboard')

@php
	$i = 1; // Sluzi kao inkrement za redni broj radnje
@endphp

@section('content')
	@if(!count($categories))
		<div class="h1 text-center my-5">
			<h2>Nemate nijednu kategoriju</h2>
			<p class="h3">Morate imati makar jednu kategoriju da bi napravili proizvod</p>
			<a href="{{ route('stores.categories.create', [$store->slug]) }}" class="">Napravite kategoriju</a>
		</div>
	@else
		<div class="container">
			<h2 class="text-center my-4">Kategorije u prodavnici "{{ $store->name }}"</h2>
			<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-default">
					<tr>
						<th colspan="6" class="text-center">
							<a href="{{ route('stores.categories.create', [$store->slug]) }}">Napravi kategoriju</a>
						</th>
					</tr>
					<tr>
						<th class="w-50p">#</th>
						<th class="text-center">Kategorija</th>
						<th class="text-center">Nadkategorija</th>
						<th class="text-center w-100p">Proizvodi</th>
						<th class="text-center w-100p">Izmeni</th>
						<th class="text-center w-100p">Izbriši</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{ $i++ }}</td>

							<td class="text-center h3">
								<a href="{{ route('stores.categories.show', [$store->slug, $category->slug]) }}">
									{{ $category->name }}
								</a>
							</td>

							@if($category->parent)
								<td class="text-center h4">
									<a href="{{ route('stores.categories.show', [$store->slug, $category->parent->slug]) }}">
										{{ $category->parent->name or '' }}
									</a>
								</td>
							@else
								<td class="text-center h4"><i class="fa fa-ban" aria-hidden="true"></i></td>
							@endif

							<td class="text-center">
								<a href="{{ route('stores.categories.products', [$store->slug, $category->slug]) }}" class="btn btn-primary">
									<i class="fa fa-archive" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<a href="{{ route('stores.categories.edit', [$store->slug, $category->slug]) }}" class="btn btn-primary">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<form method="post" action="{{ route('stores.categories.destroy', [$store->slug, $category->slug]) }}" >
									{{ csrf_field() }}
									{{ method_field('delete') }}
									<button type="submit" class="btn btn-danger">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</form>
							</td>

						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	@endif

@endsection