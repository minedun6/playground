@extends('layouts.app')

@section('content')
    <Board title="{{ $project->name }}" source="/api/projects/{{ $project->id }}"></Board>
@endsection