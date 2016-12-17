@extends('layouts.master')

@section('aside')
	<div class="panel-wrapper">
		<h3>Convertor Rapid</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				@include('components.fast-converter')
			</div>
		</div>
	</div>
	<div class="panel-wrapper">
		<div class="panel panel-default">
			<div class="panel-body">
				300x250 ad
			</div>
		</div>
	</div>
	<div class="panel-wrapper">
		<h3>Stiri</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				Ceva stiri aici ... poate?
			</div>
		</div>
	</div>
	<div class="panel-wrapper">
		<div class="panel panel-default">
			<div class="panel-body">
				facebook widget
			</div>
		</div>
	</div>
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

