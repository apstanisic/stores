@extends('layouts.dashboard')




@section('content')
	
	{{-- @include('forms.store.add') --}}
	@if(!empty($stores))
	@php
		$i = 0;
	@endphp
		
<table class="table table-striped">
	<thead class="thead-inverse">
		<tr>
			<th>#</th>
			<th>Naziv</th>
			<th>Izmeni</th>
			<th>Izbrisi</th>
		</tr>
	</thead>
	<tbody>
		@foreach($stores as $store)
			{{ $store->name }}
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $store->name }}</td>
				<td>{{ 'izmeni' }}</td>
				<td>{{ 'izbrisi' }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

	@endif

@endsection