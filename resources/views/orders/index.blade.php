@extends('layouts.dashboard')

@section('content')
	@include('partials.orders.ownerMany', compact('orders'))
@endsection