<div class="form-group">
	<label for="{{$id}}">{{$label}}</label>
	@if (isset($switch))
		<i class="fa fa-refresh" id="switch"></i>
	@endif
	<select name="{{$id}}" id="{{$id}}" class="form-control input-sm">
		@foreach (\App\Models\Currency::all() as $rate)
			@if ($rate->currency == $selected)
				<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}" selected="selected">{{$rate->title()}}</option>
			@else
				<option label="{{$rate->title()}}" value="{{$rate->todayValue->value}}">{{$rate->title()}}</option>
			@endif
		@endforeach
	</select>
</div>
