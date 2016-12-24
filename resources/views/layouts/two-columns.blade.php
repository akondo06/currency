@extends('layouts.master')

@section('aside')
	@include('components.aside')
@endsection

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				@yield('content')
			</div>
			<div class="col-md-3 col-md-pull-9">
				@yield('aside')
			</div>
		</div>
	</div>
@endsection

