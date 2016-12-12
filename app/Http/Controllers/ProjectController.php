<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Group;

class ProjectController extends Controller
{
	public function index()
	{
		return view('projects.index');
	}

	public function show(Project $project)
	{
		return view('projects.show')->withProject($project);
	}

	public function getTasksData(Project $project)
	{
		return response()->json([
            'model' => $project,
            'sub_model' => $project->tasks->groupBy('group_id')->sortByDesc('order') 
        ]);
	}

	public function getApiProjects()
	{
		$model = Project::searchPaginateAndOrder();
        $columns = Project::$columns;

        return response()->json([
            'model' => $model,
            'columns' => $columns
        ]);
  		       
	}
}
