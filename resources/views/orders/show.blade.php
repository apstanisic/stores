@extends('layouts.dashboard')

@section('content')
	@include('partials.orders.ownerOne', compact('order'))
@endsection