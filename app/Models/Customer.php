<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\DataTable\Traits\DataTable;

class Customer extends Model
{
	use DataTable;

	public static $columns = [
        'Id' => 'id',
        'Name' => 'name',
        'Email Address' => 'email',
        'Phone' => 'phone',
        'Created' => 'created_at',
        'Last Modified' => 'updated_at'
    ];

	public function projects()
	{
		return $this->hasMany(Project::class);
	}

}
