@extends('layouts.two-columns')

@section('content')
	<div class="panel-wrapper">
		<h3>Grafic evolutie curs <span>{{$currency->name}}</span></h3>
		<div class="panel panel-default">
			<div class="panel-body no-padding chart-wrapper">
				<div class="chart-container small" id="chart4"></div>
			</div>
		</div>
	</div>
	<div class="panel-wrapper">
		<h3>Cursul {{$currency->currency}} raportart la {{$base_currency}} in perioada {{roDate($start_date, 'long')}} - {{roDate($end_date, 'long')}}. </h3>
		<div class="panel panel-default">
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
					<th width="70">Variatie</th>
					<th width="14"></th>
					<th width="110">Valoare ({{$base_currency}})</th>
				</thead>
				<tbody>
					@foreach ($rates as $rate)
						<tr>
							<td>{{roDate($rate->published_on)}}</td>
							@include('components.currency-variation', ['variation' => $rate->variation()])
							<td align="right">{{roNumber($rate->converted_value)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	var sixMonthsAgo = new Date();
	sixMonthsAgo.setDate(sixMonthsAgo.getDate() - 180);
	window.akdGraph4 = { currency: '{{$currency->currency}}', baseCurrency: '{{$base_currency}}', color: '#ff00ff', startDate: sixMonthsAgo };
</script>
@endsection
