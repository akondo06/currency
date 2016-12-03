<div class="form-group">
	<label for="{{$id}}">{{$label}}</label>
	@if (isset($switch))
		<i class="fa fa-refresh" id="switch"></i>
	@endif
	<ul class="nav nav-pills list-input currencies-list">
		<input type="hidden" id="{{$id}}" value="{{$selected}}" />
		@foreach (\App\Models\Currency::all() as $rate)
			@if ($rate->currency == $selected)
				<li data-value="{{$rate->currency}}" class="active"><a href="#" data-toggle="tooltip" data-placement="top" title="{{$rate->name}}">{{$rate->currency}}</a></li>
			@else
				<li data-value="{{$rate->currency}}"><a href="#" data-toggle="tooltip" data-placement="top" title="{{$rate->name}}">{{$rate->currency}}</a></li>
			@endif
		@endforeach
	</ul>
</div>
