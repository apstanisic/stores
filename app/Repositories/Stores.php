<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
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
			return $this->model->all();
		} else {
			return $this->model->where('user_id', $user->id)->get();
		}
	}

	public function insert()
	{

	}

}