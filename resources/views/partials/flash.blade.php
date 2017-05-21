@include('partials.errors')

@if (session()->has('flash_danger'))
	@component('partials.alert')
		@slot('type')
			danger
		@endslot
		@slot('message')
			{{ session('flash_danger') }}
		@endslot
	@endcomponent
@endif

@if (session()->has('flash_success'))
	@component('partials.alert')
		@slot('type')
			success
		@endslot
		@slot('message')
			{{ session('flash_success') }}
		@endslot
	@endcomponent
@endif