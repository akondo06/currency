@extends('layouts.two-columns')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">Grafic evolutie curs <span>{{$currency->name}}</span></div>
		</div>
		<div class="panel-body no-padding">
			<div class="chart-container small" id="chart4"></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Cursul {{$currency->currency}} raportart la {{$base_currency}} in perioada {{date('d F Y', strtotime($start_date))}} - {{date('d F Y', strtotime($end_date))}}. 
		</div>
		<div class="panel-body">
			<form method="post" class="form-inline">
				@include('components.currencies-select', ['id' => 'base_currency', 'currencyAsValue' => true, 'selected' => $base_currency, 'exclude' => [$currency->currency], 'size' => 'sm', 'label' => 'Contra'])
				@include('components.date-picker', ['id' => 'start_date', 'value' => $start_date, 'size' => 'sm', 'label' => 'intre'])
				@include('components.date-picker', ['id' => 'end_date', 'value' => $end_date, 'size' => 'sm', 'label' => ' - '])
				<input type="submit" name="display" value="Update" class="btn btn-primary btn-sm">
			</form>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<th>Data</th>
				<th>Variatie</th>
				<th>Valoare ({{$base_currency}})</th>
			</thead>
			<tbody>
				@foreach ($rates as $rate)
					<tr>
						<td>{{$rate->published_on}}</td>
						<td>{{$rate->variation()}}</td>
						<td>{{$rate->converted_value}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	var sixMonthsAgo = new Date();
	sixMonthsAgo.setDate(sixMonthsAgo.getDate() - 180);
	window.akdGraph4 = { currency: '{{$currency->currency}}', baseCurrency: '{{$base_currency}}', color: '#ff00ff', startDate: sixMonthsAgo };
</script>
@endsection
