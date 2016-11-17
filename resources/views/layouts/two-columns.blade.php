@extends('layouts.master')

@section('aside') 
	<div class="panel panel-default">
		<div class="panel-heading">Convertor Rapid</div>
		<div class="panel-body">
			<form class="fast-converter">
			<p>Calculeaza conform <b>cursului valutar BNR</b> din <b>{{date('d F Y')}}</b>:</p>

			<div class="form-group">
				<label for="convert-from">Transforma din:</label>
				<select name="convert-from" id="convert-from" class="form-control input-sm">
					@foreach (\App\Models\Currency::all() as $rate)
						@if ($rate->currency == "EUR")
							<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}" selected="selected">{{$rate->title()}}</option>
						@else
							<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}">{{$rate->title()}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="convert-to">in:</label> <i class="fa fa-refresh" id="switch"></i>
				<select name="convert-to" id="convert-to" class="form-control input-sm">
					@foreach (\App\Models\Currency::all() as $rate)
						@if ($rate->currency == "RON")
							<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}" selected="selected">{{$rate->title()}}</option>
						@else
							<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}">{{$rate->title()}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group amount">
				<label for="amount">Suma:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-money"></i></div>
					<input type="text" id="amount" class="form-control input-sm">
				</div>
			</div>
			<div class="form-group result">
				<label for="result">Rezultat:</label>
				<input type="text" id="result" class="form-control input-sm" value="0">
			</div>
		</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			300x250 ad
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Stiri</div>
		<div class="panel-body">
			Ceva stiri aici ... poate?
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			facebook widget
		</div>
	</div>
@endsection

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@yield('aside')
			</div>
			<div class="col-md-9">
				@yield('content')
			</div>
		</div>
	</div>
@endsection

