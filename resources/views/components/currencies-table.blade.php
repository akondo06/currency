<table class="table table-striped table-hover">
	<thead>
		<th width="30">#</th>
		<th width="40">Simbol</th>
		<th>Denumire valuta</th>
		@if (isset($with_variation))
			<th width="90">{{roDate($rates[0]->two_days_before->published_on)}}</th>
			<th width="90">{{roDate($rates[0]->yesterday->published_on)}}</th>
			<th width="70">Variatie</th>
			<th width="14"></th>
		@endif
		@if (isset($value_currency))
		{{-- <th width="110">{{roDate($rates[0]->published_on)}}</th> --}}
		<th width="110"></th>
		@else
		<th width="90">{{roDate($rates[0]->published_on)}}</th>
		@endif
	</thead>
	<tbody>
		@foreach ($rates as $rate)
			@if (!isset($excludeCurrencies) || !in_array($rate->currency, $excludeCurrencies))
				<tr>
					<td><span class="flag {{strtolower($rate->currency)}}"></span></td>
					<td align="middle">{{$rate->currency}}</td>
					<td><a href="{{urlFor('currency', ['slug'=> $rate->currencyObj->slug])}}">{{$rate->currencyObj->name}}</a></td>
					@if (isset($with_variation))
						<td align="right">{{roNumber($rate->two_days_before->converted_value)}}</td>
						<td align="right">{{roNumber($rate->yesterday->converted_value)}}</td>
						@include('components.currency-variation', ['variation' => $rate->variation()])
					@endif
					<td align="right">
						@if (isset($rate->converted_value))
							{{roNumber($rate->converted_value)}}
						@else
							{{roNumber($rate->value)}}
						@endif
						@if (isset($value_currency))
							{{$value_currency}}
						@endif
					</td>
				</tr>
			@endif
		@endforeach
	</tbody>
</table>
