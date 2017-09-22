@extends('layouts.shopping')

@section('content')

	<h1 class="display-4 mt-5 mx-2 text-center">{{ $store->name }}</h1>

	<h2 class="mt-5 mx-2 text-center">{{ $store->description }}</h2>

@endsection