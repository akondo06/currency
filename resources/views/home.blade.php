@extends('layouts.one-column')

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-1-currency">EUR</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						@include('components.currencies-dropdown', ['chart' => 1])
					</div>
				</div>
				<div class="panel-body no-padding">
					<div class="chart-container small" id="chart1"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-2-currency">USD</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						@include('components.currencies-dropdown', ['chart' => 2])
					</div>
				</div>
				<div class="panel-body no-padding">
					
					<div class="chart-container small" id="chart2"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-3-currency">GBP</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						@include('components.currencies-dropdown', ['chart' => 3])
					</div>
				</div>
				<div class="panel-body no-padding">
					<div class="chart-container small" id="chart3"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Convertor Rapid</div>
				<div class="panel-body">
					@include('components.fast-converter')
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Cursul BNR afisat astazi {{date('d F Y')}} a fost licitat de catre BNR in data de: {{date('d F Y', strtotime($rates[0]->published_on))}}, raportat la {{$currency->title()}}</div>
				<div class="panel-body">
					{{-- <pre style="height: 100px;">
						{{$que}}
					</pre> --}}
					<form class="form-inline" method="post">
						@include('components.date-picker', ['id' => 'datepicker', 'value' => $index_date, 'size' => 'sm', 'label' => 'Afiseaza curs BNR din data de:'])
						@include('components.currencies-select', ['id' => 'index_currency', 'selected' => $currency->currency, 'size' => 'sm', 'label' => 'raportat la'])
						<div class="form-group">
							<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
						</div>
					</form>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<th>#</th>
						<th>Simbol</th>
						<th>Denumire valuta</th>
						<th>{{$rates[0]->two_days_before->published_on}}</th>
						<th>{{$rates[0]->yesterday->published_on}}</th>
						<th>Variatie</th>
						<th>{{$rates[0]->published_on}}</th>
					</thead>
					<tbody>
						@foreach ($rates as $rate)
							<tr>
								<td><span class="flag {{strtolower($rate->currency)}}"></span></td>
								<td>{{$rate->currency}}</td>
								<td><a href="{{urlFor('currency', ['slug'=> $rate->currencyObj->slug])}}">{{$rate->currencyObj->name}}</a></td>
								<td>{{$rate->two_days_before->converted_value}}</td>
								<td>{{$rate->yesterday->converted_value}}</td>
								<td>{{$rate->variation()}}</td>
								<td>{{$rate->converted_value}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
