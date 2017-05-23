@extends('layouts.dashboard')


@section('content')

<p class="display-4 mt-4 text-center">{{ $category->name }}</p>

<div class="text-center">
	<a class="btn btn-info" href="{{ route('stores.categories.edit', [$category->store->slug, $category->slug]) }}">Izmenite kategoriju</a>
	<a class="btn btn-info" href="{{ route('stores.categories.products', [$category->store->slug, $category->slug]) }}">Proizvodi</a>
</div>

<p class="h3 text-center mt-4">Imate:</p>
<p class="display-4 text-center">{{ $category->products->count() }} <small class="h4"> proizvod/a.</small></p>
<hr>

<p class="h3 text-center mt-4"></p>
<p class="display-4 text-center">{{ $category->children()->count() }} <small class="h4"> podkategoriju/e.</small></p>


@endsection