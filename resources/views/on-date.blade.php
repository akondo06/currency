@extends('layouts.two-columns')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Cursul pe data de {{date('d F Y', strtotime($date))}}. 
		</div>
		@include('components.currencies-table', ['rates' => $rates, 'excludeCurrencies' => ['RON'], 'value_currency' => 'RON'])
	</div>
@endsection
