<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\DataTable\Traits\DataTable;

class Project extends Model
{

	use DataTable;

	protected $dates = [
		'start_date',
		'due_date'
	];

	public static $relationships = 'owner';

    public static $selectColumns = [
        'id',
        'name',
        'start_date',
        'due_date',
        'progress',
        'customer_id'
    ];

	public static $columns = [
		'Id' => 'id',
		'Name' => 'name',
		'Start Date' => 'start_date',
		'Deadline' => 'due_date',
		'Progress' => 'progress',
		'Owner' => 'owner.name'
	];

	public function owner()
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}

	public function tasks()
	{
		return $this->hasMany(Task::class, 'project_id');
	}

    /**
     * Model Scope to grab projects which their deadline(due_date) is this year
     * @method scopeThisYear
     * @param  $query
     * @return @mix
     */
    public function scopeThisYear($query)
	{
		return $query->where('due_date', '>=', Carbon::now()->subYear(10));
	}

}
