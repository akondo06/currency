<header>
	<nav class="navbar navbar-default navbar-main">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand navbar-left" href="{{urlFor('index')}}">Curs Valutar</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li {!!isRoute('index')!!}><a href="{{urlFor('index')}}">Acasa</a></li>
					<li {!!isRoute('currency-converter')!!}><a href="{{urlFor('currency-converter')}}">Convertor Valutar</a></li>
					<li {!!isRoute('currency-evolution')!!}><a href="{{urlFor('currency-evolution')}}">Evolutie Curs</a></li>
					{{-- <li><a href="{{urlFor('page', ['name' => 'curs-valutar-banci'])}}">Curs Valutar Banci</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cel mai bun curs <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-euro'])}}">EURO</a></li>
							<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-dolar'])}}">USD - Dolar American</a></li>
							<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-lira-sterlina'])}}">GBP - Lira Sterlina</a></li>
							<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-franc-elvetian'])}}">CHF - Francul Elvetian</a></li>
						</ul>
					</li> --}}
					<li {!!isRoute(['history', 'onDate'])!!}><a href="{{urlFor('history')}}">Istoric Curs Valutar</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-default navbar-info">
		<div class="container">
			<div class="nav navbar-nav navbar-left page-title">
				<h1>Curs Valutar</h1>
			</div>
			<div class="nav navbar-nav navbar-right todays-rates">
				@foreach (ratesOnDate() as $rate)
				<div class="currency" title="{{$rate->currency}}">
					<span class="flag {{strtolower($rate->currency)}}"></span>
					<span class="value">{{roNumber($rate->converted_value, 2)}} RON</span>
				</div>
				@endforeach
			</div>
		</div>
	</nav>
</header>
