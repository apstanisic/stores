	<div class="sidebar bg-dark pt-2 d-inline" id="sidebar">

			<button type="button" class="btn-transparent text-lightgrey" id="sidebarToggle">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Skupi navigaciju</span>
				</div>
			</button>

		<a href="{{ route('stores.index') }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-home" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Početna</span>
			</div>
		</a>


		<a href="{{ route('stores.show', [$store->slug]) }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-shopping-basket" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Prodavnica{{--  - "{{ $store->name }}" --}}</span>
			</div>
		</a>


		<a href="{{ route('stores.orders.index', [$store->slug]) }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-files-o" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Porudžbine</span>
			</div>
		</a>


		<a href="{{ route('stores.products.index', [$store->slug]) }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-archive" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Proizvodi</span>
			</div>
		</a>

		<a href="{{ route('stores.categories.index', [$store->slug]) }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-list-alt" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Kategorije</span>
			</div>
		</a>



		<a href="{{ route('stores.edit', [$store->slug]) }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Izmeni prodavnicu</span>
			</div>
		</a>


		<form action="{{ route('stores.destroy', [$store->slug]) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('delete') }}
			<button type="submit" class="btn-transparent text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Izbriši prodavnicu</span>
				</div>
			</button>
		</form>



		<a href="{{ route('user.index') }}" class="text-lightgrey">
			<div class="sidebar-block">
				<div class="sidebar-icon">
					<i class="fa fa-user" aria-hidden="true"></i>
				</div>
				<span class="sidebar-text">Profil</span>
			</div>
		</a>

		<form action="{{ route('logout') }}" method="post">
			{{ csrf_field() }}
			<button type="submit" class="btn-transparent text-lightgrey">
				<div class="sidebar-block">
					<div class="sidebar-icon">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
					</div>
					<span class="sidebar-text">Izlogujte se</span>
				</div>
			</button>
		</form>

	</div>