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
				<div class="panel-heading">Cursul BNR afisat astazi {{date('d F Y')}} a fost licitat de catre BNR in data de: {{date('d F Y', strtotime($rates[0]->published_on))}}</div>
				{{-- <div class="panel-body">
					tabel aci ...
				</div> --}}
				<table class="table table-hover">
					<thead>
						<th>#</th>
						<th>Simbol</th>
						<th>Denumire valuta</th>
						<th>Azi</th>
						<th>Maine</th>
						<th>variatie</th>
						<th>Poimaine</th>
					</thead>
					<tbody>
						@foreach ($rates as $rate)
						<tr><td>FLAG</td><td>{{$rate->currency}}</td><td>{{$rate->currency}}</td><td>{{$rate->currency}}</td><td>{{$rate->value}}</td><td>-0,0059</td><td>4,4978</td></tr>
						@endforeach
						{{-- <tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr>
						<tr><td>FLAG</td><td>EUR</td><td>Euro</td><td>4,4955</td><td>4,5037</td><td>-0,0059</td><td>4,4978</td></tr> --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
