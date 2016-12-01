@extends('layouts.one-column')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Evolutie Curs</div>
		<div class="panel-body no-padding">
			<div class="chart-container stock" id="chart-currency-evolution" data-currency="EUR"></div>
		</div>
	</div>
@endsection

@section('scripts')
<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
@endsection