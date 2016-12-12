<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    
	public function index()
	{
		return view('customers.index');
	}

	public function getApiCustomers()
	{
		$model = Customer::searchPaginateAndOrder();
        $columns = Customer::$columns;

        return response()->json([
            'model' => $model,
            'columns' => array_keys($columns)
        ]);
	}

}
