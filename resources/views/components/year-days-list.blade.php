<div class="year" data-year="{{$year->year}}">
	@foreach ($year->months as $month)
		<div class="month">
			<h4>{{$month->month}}</h4>
			<ul class="nav nav-pills nav-month-day">
				@foreach ($month->days as $day)
					<li><a href="{{urlFor('onDate', ['date' => $year->year.'-'.$month->no.'-'.$day])}}" title="Curs valutar {{$day}} {{$month->month}} {{$year->year}}">{{$day}}</a></li>
				@endforeach
			</ul>
		</div>
	@endforeach
</div>
