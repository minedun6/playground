@extends('layouts.app')

@section('content')

<span class="text-center">Number of Projects: {{ $customer->projects()->count() }}</span>
<a class="btn btn-info" href="{{ route('customer.projects', $customer->id) }}" role="button">See Customer Projects</a>

@endsection