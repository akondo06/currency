@extends('layouts.one-column')

@section('content')
	<div class="panel-wrapper">
		<h3>Evolutie Curs</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="chart-container stock" id="chart-currency-evolution" data-currency="EUR"></div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
@endsection