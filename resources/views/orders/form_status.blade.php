<form action="{{ route('stores.orders.updateStatus', [$order->store->slug, $order->slug]) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<select name="status_id" class="form-control" id="changeStatus">
		@foreach(\App\Status::where('id', '!=', 7)->get() as $status)
		<option value="{{ $order->status->slug }}" {{ ($status->slug === $order->status->slug) ? 'selected' : '' }}>{{ $status->description }}</option>
		@endforeach
	</select>
	<button type="submit" class="btn btn-primary btn-block mt-2">Izmeni status</button>
</form>