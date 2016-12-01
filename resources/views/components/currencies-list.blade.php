<div class="form-group">
	<label for="{{$id}}">{{$label}}</label>
	@if (isset($switch))
		<i class="fa fa-refresh" id="switch"></i>
	@endif
	<ul class="nav nav-pills currencies-list" id="{{$id}}">
		@foreach (\App\Models\Currency::all() as $rate)
			@if ($rate->currency == $selected)
				<li class="active" data-tooltip="{{$rate->name}}"><a href="#">{{$rate->currency}}</a></li>
			@else
				<li data-tooltip="{{$rate->name}}"><a href="#">{{$rate->currency}}</a></li>
			@endif
		@endforeach
	</ul>
</div>
