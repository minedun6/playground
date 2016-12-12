@extends('layouts.app')

@section('content')
	
	<Datatable source="/api/projects" title="Projects" columns="owner.name"></Datatable>

@endsection