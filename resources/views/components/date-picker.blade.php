<div class="form-group">
	<label for="{{$id}}">{{$label}}</label>
	<div class="input-group date" data-provide="datepicker">
		@if (isset($size))
			<input type="text" class="form-control input-{{$size}}" id="{{$id}}" value="{{$value}}" />
		@else
			<input type="text" class="form-control" id="{{$id}}" value="{{$value}}" />
		@endif
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
	</div>
</div>
