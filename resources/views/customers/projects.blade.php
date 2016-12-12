@extends('layouts.app')

@section('content')

<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Progress</th>
			<th>Start Date</th>
			<th>Due Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach($projects as $project)
			<tr>
				<td>{{ $project->id }}</td>
				<td>{{$project->name }}</td>
				<td>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $project->progress }}%;">
						  </div>
						</div>
				</td>
				<td>{{$project->start_date->format('Y-M-d') }}</td>
				<td>{{$project->due_date->diffForHumans() }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<ul class="pagination pagination-sm">
	{{ $projects->links() }}
</ul>	

@endsection