<table class="table table-striped table-hover">
	<thead>
		<th>#</th>
		<th>Simbol</th>
		<th>Denumire valuta</th>
		@if (isset($with_variation))
			<th>{{$rates[0]->two_days_before->published_on}}</th>
			<th>{{$rates[0]->yesterday->published_on}}</th>
			<th>Variatie</th>
		@endif
		<th>{{$rates[0]->published_on}}</th>
	</thead>
	<tbody>
		@foreach ($rates as $rate)
			@if (!isset($excludeCurrencies) || !in_array($rate->currency, $excludeCurrencies))
				<tr>
					<td><span class="flag {{strtolower($rate->currency)}}"></span></td>
					<td>{{$rate->currency}}</td>
					<td><a href="{{urlFor('currency', ['slug'=> $rate->currencyObj->slug])}}">{{$rate->currencyObj->name}}</a></td>
					@if (isset($with_variation))
						<td>{{$rate->two_days_before->converted_value}}</td>
						<td>{{$rate->yesterday->converted_value}}</td>
						<td>{{$rate->variation()}}</td>
					@endif
					<td>
						@if (isset($rate->converted_value))
							{{$rate->converted_value}}
						@else
							{{$rate->value}}
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
