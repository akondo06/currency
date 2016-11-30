@extends('layouts.master')

@section('aside') 
	<div class="panel panel-default">
		<div class="panel-heading">Convertor Rapid</div>
		<div class="panel-body">
			@include('components.fast-converter')
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			300x250 ad
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Stiri</div>
		<div class="panel-body">
			Ceva stiri aici ... poate?
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			facebook widget
		</div>
	</div>
@endsection

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@yield('aside')
			</div>
			<div class="col-md-9">
				@yield('content')
			</div>
		</div>
	</div>
@endsection

