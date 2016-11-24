<div class="btn-group currencies-dropdown" data-chart="{{$chart}}">
	<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="caret"></span>
		<span class="sr-only">Afiseaza grafic curs valutar BNR in alta moneda</span>
	</button>
	<ul class="dropdown-menu">
		<li class="dropdown-header">Schimba grafic curs cu:</li>
		<li role="separator" class="divider"></li>
		@foreach (\App\Models\Currency::excludeBase()->get() as $c)
			<li><a href="javascript:void(0)" data-currency="{{$c->currency}}">{{$c->name}}</a></li>
		@endforeach
	</ul>
</div>
