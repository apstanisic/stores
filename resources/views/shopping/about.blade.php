@extends('layouts.shopping')

@section('content')

	<h1 class="display-1 mt-5 text-center">{{ $store->name }}</h1>

	<h2 class="display-1 mt-5 text-center">{{ $store->description }}</h2>

@endsection