@extends('layouts.two-columns')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Istoric Curs Valutar</div>
		<div class="panel-body">
			<ul class="nav nav-tabs" role="tablist">
				@foreach ($years as $index => $year)
					@if ($index == 4)
						<li role="presentation" class="dropdown">
							<a href="#" id="more-years" class="dropdown-toggle" data-toggle="dropdown" aria-controls="more-years-contents" aria-expanded="false">
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="more" id="more-of-them">
					@endif
					@if ($index == 0)
						<li role="presentation" class="active"><a href="#tab-{{$index}}" aria-controls="tab-{{$index}}" role="tab" data-toggle="tab">Istoric {{$year->year}}</a></li>
					@else
						<li role="presentation"><a href="#tab-{{$index}}" aria-controls="tab-{{$index}}" role="tab" data-toggle="tab">Istoric {{$year->year}}</a></li>
					@endif

					@if ($index >= 4 && $index == count($years)-1)
								</ul>
						</li>
					@endif
				@endforeach
			</ul>
			<div class="tab-content">
				@foreach ($years as $index => $year)
					@if ($index == 0)
						<div role="tabpanel" class="tab-pane active" id="tab-{{$index}}">
							@include('components.year-days-list', ['year' => $year])
						</div>
					@else
						<div role="tabpanel" class="tab-pane" id="tab-{{$index}}">
							@include('components.year-days-list', ['year' => $year])
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
@endsection
