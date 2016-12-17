@extends('layouts.two-columns')

@section('content')
	<div class="panel-wrapper">
		<h3>Cursul pe data de {{roDate($date, 'long')}}.</h3>
		<div class="panel panel-default">
			@include('components.currencies-table', ['rates' => $rates, 'excludeCurrencies' => ['RON'], 'value_currency' => 'RON'])
		</div>
	</div>
@endsection
