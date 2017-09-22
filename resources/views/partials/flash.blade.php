@include('partials.errors')

@if (session()->has('flash_danger'))
	@component('partials.alert')
		@slot('type', 'danger')
		@slot('message', session('flash_danger'))
			{{-- {{  }} --}}
		{{-- @endslot --}}
	@endcomponent
@endif

@if (session()->has('flash_success'))
	@component('partials.alert')
		@slot('type', 'success')
			{{-- success --}}
		{{-- @endslot --}}
		@slot('message', session('flash_success'))
			{{-- {{ session('flash_success') }} --}}
		{{-- @endslot --}}
	@endcomponent
@endif