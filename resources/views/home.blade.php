@extends('layouts.two-columns')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs <span class="chart-1-currency">EUR</span> din ultimele 3 luni</div>
				<div class="panel-body no-padding">
					@include('components.currencies-dropdown', ['chart' => 1])
					<div class="chart-container small" id="chart1"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs <span class="chart-2-currency">USD</span> din ultimele 3 luni</div>
				<div class="panel-body no-padding">
					@include('components.currencies-dropdown', ['chart' => 2])
					<div class="chart-container small" id="chart2"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Cursul BNR afisat astazi {{date('d F Y')}} a fost licitat de catre BNR in data de: {{date('d F Y', strtotime($rates[0]->published_on))}}, raportat la {{$currency->title()}}</div>
				<div class="panel-body">
					{{-- <pre style="height: 100px;">
						{{$que}}
					</pre> --}}
					<form class="form-inline" method="post">
						<div class="form-group">
							<label for="datepicker">Afiseaza curs BNR din data de:</label>
							<input type="text" name="index_date" value="{{$index_date}}" class="form-control input-sm datepicker" id="datepicker" />
						</div>
						<div class="form-group">
							<label for="index_currency">raportat la</label>
							<select name="index_currency" id="index_currency" class="form-control input-sm">
								@foreach (\App\Models\Currency::all() as $r)
									@if ($r->currency == $currency->currency)
										<option label="{{$r->title()}}" value="{{$r->currency}}" selected="selected">{{$r->title()}}</option>
									@else
										<option label="{{$r->title()}}" value="{{$r->currency}}">{{$r->title()}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
						</div>
					</form>
				</div>
				<table class="table table-hover">
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
								<td>{{$rate->currencyObj->name}}</td>
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
