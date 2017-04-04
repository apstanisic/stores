@extends('layouts.master')




@section('content')
	<div class="container-fluid bg-inverse p-0">
		<div class="container">
			<div class="row py-5">

		        <div class="col-12 col-md-6 text-white px-md-5 text-center d-flex align-items-center">
		        	<div>
			        	<h2 class="display-4">Vasa prodavnica</h2>
			        	<p class="h5 my-4">
			        		Napravite prodavnicu za samo nekoliko minuta. Brzo, pouzdano, povoljno.
			        	</p>
		        	</div>
		        </div>

		        <div class="col-12 col-md-6">
		        	@include('forms.auth.register')
				</div>

		    </div>
	    </div>
    </div>

	<div class="container">
		<div class="row my-5">
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis nisi voluptate placeat reprehenderit, accusamus nostrum ea itaque voluptas, beatae rem temporibus aperiam cumque eaque. Atque vero nihil laborum error maxime.</div>
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem consequatur suscipit quod, veniam architecto expedita eum corporis deleniti facilis cumque. Dolore tenetur repellat deleniti natus porro consequatur unde dolorum temporibus!</div>
		</div>
		<div class="row my-5">
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse vitae saepe voluptate porro dolore, obcaecati ullam facere, nostrum a cum doloribus animi fugiat soluta suscipit, corporis at iusto accusantium quia!</div>
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet consectetur, enim, aperiam tempora voluptatum ducimus minima deserunt blanditiis doloremque illo numquam quis, vitae nam praesentium qui modi iusto delectus exercitationem.</div>
		</div>
		<div class="row my-5">
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione voluptatibus reprehenderit eaque fugit, officia voluptatem consectetur nemo dolor asperiores soluta, expedita, quo impedit tempore nam vero temporibus cumque fugiat excepturi.</div>
			<div class="col-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis voluptatem commodi recusandae fugit. Minus vel, ad totam provident aperiam, qui, cum obcaecati quasi, natus similique harum facilis quae reprehenderit ut.</div>
		</div>
	</div>

@endsection