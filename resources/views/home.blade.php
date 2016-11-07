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
				<div class="panel-heading">Cursul BNR afisat astazi {{date('d F Y')}} a fost licitat de catre BNR in data de: {{date('d F Y', strtotime($rates[0]->published_on))}}, raportat la {{$rate->currency_name}} ({{$rate->currency}})</div>
				{{-- <div class="panel-body">
					<pre style="height: 600px;">
						{{$rates->toJSON()}}
					</pre>
				</div> --}}
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
