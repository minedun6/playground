<?php namespace App\DataTable\Traits;

use Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait DataTable {

	public function scopeSearchPaginateAndOrder($query)
	{
		$request = app()->make('request');

		$v = Validator::make($request->only([
			'column', 'order', 'per_page'
		]), [
			'column' => 'required|in:' . implode(',', self::$columns),
			'order' => 'required|in:asc,desc',
			'per_page' => 'required'
		]);

		return $queryBuilder = $query
			->select(self::$selectColumns)
			->with([self::$relationships => function($q) {
				$q->select('name', 'id');
			}])
			->orderBy($request->column, $request->order)
			->where(function($query) use ($request) {
				if($request->has('input_query')) {
					foreach (self::$columns as $column) {
						$query->orWhere($column, 'like' ,'%'.$request->input_query.'%');
					}
				}
			})->paginate($request->per_page);
		/*$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$currentPageSearchResults = $queryBuilder->slice(($currentPage - 1) * $request->per_page, $request->per_page)->all();
		$entries = new LengthAwarePaginator($currentPageSearchResults, count($queryBuilder), $request->per_page);
		return $entries;*/

	}

}
