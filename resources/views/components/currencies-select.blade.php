<div class="form-group">
	<label for="{{$id}}">{{$label}}</label>
	@if (isset($switch))
		<i class="fa fa-refresh" id="switch"></i>
	@endif
	@if (isset($size))
		<select name="{{$id}}" id="{{$id}}" class="form-control input-{{$size}}">
	@else
		<select name="{{$id}}" id="{{$id}}" class="form-control">
	@endif
		@foreach (\App\Models\Currency::all() as $rate)
			@if (!isset($exclude) || !in_array($rate->currency, $exclude))
				@if ($rate->currency == $selected)
					@if (isset($currencyAsValue))
						<option label="{{$rate->title()}}" value="{{$rate->currency}}" selected="selected">{{$rate->title()}}</option>
					@else
						<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}" selected="selected">{{$rate->title()}}</option>
					@endif
				@else
					@if (isset($currencyAsValue))
						<option label="{{$rate->title()}}" value="{{$rate->currency}}">{{$rate->title()}}</option>
					@else
						<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}">{{$rate->title()}}</option>
					@endif
				@endif
			@endif
		@endforeach
	</select>
</div>
