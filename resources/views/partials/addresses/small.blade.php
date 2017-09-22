<div class="container">
    <div class="card m-3">
        <div class="card-header bg-secondary text-white d-flex justify-content-between flex-wrap">
            <span class="h3 mb-0">{{ $address->name }}</span>
            <span> {{ $routes or '' }} </span>
        </div>
        <div class="card-block p-2">
            <p class="h4">{{ $address->street_name . ' ' . $address->building_number }} </p>
            <p class="h4">{{ $address->postal_code . ' ' . $address->city }}</p>

        </div>
    </div>
</div>