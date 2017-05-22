<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreRequest;
use App\Category;
use App\Order;
use App\Product;
use App\Store;
use App\User;

class Stores extends Repository {

	public function __construct()
	{
		$this->model = new Store;
	}

	public function all(User $user = null)
	{
		if ($user === null) {
			$this->data = $this->model->all();
		} else {
			$this->data = $this->model->where('user_id', $user->id)->get();
		}
		$this->success = true;
		$this->message = 'Requested stores';

		return $this;
	}

	public function create(array $data, User $user)
	{
		// $store = auth()->user()->stores()->create($data->all());
		$store = $user->stores()->create([
			'name' => $data['name'],
			'description' => $data['description']
		]);
        // Default category
        $store->categories()->create(['name' => 'Nesvrstano']);

    	$this->success = true;
    	$this->message = 'Successfuly added new store';

    	return $this;
	}

}