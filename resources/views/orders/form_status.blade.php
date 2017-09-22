<form action="{{ route('stores.orders.updateStatus', [$order->store->slug, $order->slug]) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<select name="status_id" class="form-control" id="changeStatus">
		@foreach($status as $oneStatus)
			<option value="{{ $oneStatus->id }}" {{ ($oneStatus->name === $order->status->name) ? 'selected' : '' }}>
				{{ $oneStatus->description }}
			</option>
		@endforeach
	</select>
	<button type="submit" class="btn btn-primary btn-block mt-2">Izmeni status</button>
</form>