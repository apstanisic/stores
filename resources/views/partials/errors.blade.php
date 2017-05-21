@if ($errors->any())
	@component('partials.alert')
		@slot('type')
			danger
		@endslot
		@slot('message')
			<ul class="my-0 list-unstyled">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endslot
	@endcomponent
@endif