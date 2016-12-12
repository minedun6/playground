@extends('layouts.app')

@section('content')
	<form method="GET" action="{{ route('google.login') }}">
        <button class="btn btn-primary">Login with Google</button>
    </form>
@endsection