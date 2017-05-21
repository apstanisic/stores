@extends('layouts.dashboard')

@section('content')

	@include('partials.products.ownerMany', compact('products'))

@endsection