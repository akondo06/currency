@extends('layouts.two-columns')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs EUR din ultimele 3 luni</div>
				<div class="panel-body no-padding" id="chartdiv">
					{{-- GRAF ACI <br />
					https://www.amcharts.com/demos/zoomable-value-axis/ <br />
					http://www.curs-valutar-bnr.ro/ --}}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs USD din ultimele 3 luni</div>
				<div class="panel-body">
					GRAF ACI <br />
					https://www.amcharts.com/demos/zoomable-value-axis/ <br />
					http://www.curs-valutar-bnr.ro/
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Cursul BNR afisat astazi {{date('d F Y')}} a fost licitat de catre BNR in data de: {{date('d F Y', strtotime($rateValues[0]->published_on))}}, raportat la {{$rate->title()}}</div>
				<div class="panel-body">
					{{-- <pre style="height: 600px;">
						{{$rateValues->toJSON()}}
					</pre> --}}
					<form class="form-inline" method="post">
						<div class="form-group">
							<label for="datepicker">Afiseaza curs BNR din data de:</label>
							<input type="text" name="index_date" value="{{$index_date}}" class="form-control input-sm datepicker" id="datepicker" />
						</div>
						<div class="form-group">
							<label for="index_currency">raportat la</label>
							<select name="index_currency" id="index_currency" class="form-control input-sm">
								@foreach (\App\Models\Rate::all() as $r)
									@if ($r->currency == $rate->currency)
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
						<th>Azi</th>
					</thead>
					<tbody>
						@foreach ($rateValues as $rate)
							<tr>
								<td><span class="flag {{strtolower($rate->currency)}}"></span></td>
								<td>{{$rate->currency}}</td>
								<td>{{$rate->rate->currency_name}}</td>
								<td>{{$rate->value}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
