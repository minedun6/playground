@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-7">
				<h3 class="panel-title">List of Files {{ request()->get('query') ?? '' }}</h3>
			</div>
			<div class="col-md-5">
				<form role="search" method="get" action="{{ route('dashboard') }}">
			    	<div class="input-group">
			      		<input type="text" name="query" class="form-control">
			      		<div class="input-group-btn">
			        		<button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
			      		</div>
			    	</div>
			  	</form>
			</div>
		</div>
	</div>

    <div class="panel-body">
        @foreach(array_chunk($files, 4) as $row)
			<div class="row">
				@foreach($row as $key => $file)
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-9">
										<span class="img-circle"><img src="{{ $file->iconLink }}"></span> {{ $file->name }}
									</div>
									<div class="col-md-2">
										{{ Carbon\Carbon::parse($file->modifiedTime)->format('d.M.Y') }}
									</div>
								</div>
							</div>
							<div class="panel-body">
								
							</div>
						</div>
					</div>
				@endforeach
			</div>
        @endforeach
    </div>
</div>
@endsection
