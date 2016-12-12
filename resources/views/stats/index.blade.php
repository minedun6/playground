@extends('layouts.app')

@section('content')

    <datachart
        source="{{ route('api.stats') }}"
        title="Customers Stats"
        width="400"
        height="200"
        >
    </datachart>

@endsection
