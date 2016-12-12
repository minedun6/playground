<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stats.index');
    }

    /**
     * Returns a Json representation of the data to display on the chart.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatsData()
    {
        return Project::selectRaw('YEAR(due_date) as year, count(id) as nbrProjects')
                ->groupBy('year')
                ->pluck('nbrProjects', 'year');
    }

}
