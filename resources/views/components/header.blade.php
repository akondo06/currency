<header>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{urlFor('index')}}">Curs Valutar</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="{{urlFor('page', ['name' => 'convertor-valutar'])}}">Convertor Valutar</a></li>
						<li><a href="{{urlFor('page', ['name' => 'evolutie-curs'])}}">Evolutie Curs</a></li>
						<li><a href="{{urlFor('page', ['name' => 'curs-valutar-banci'])}}">Curs Valutar Banci</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cel mai bun curs <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-euro'])}}">EURO</a></li>
								<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-dolar'])}}">USD - Dolar American</a></li>
								<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-lira-sterlina'])}}">GBP - Lira Sterlina</a></li>
								<li><a href="{{urlFor('page', ['name' => 'cel-mai-bun-curs-franc-elvetian'])}}">CHF - Francul Elvetian</a></li>
							</ul>
						</li>
						<li><a href="{{urlFor('page', ['name' => 'istoric-curs-valutar'])}}">Istoric Curs Valutar</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>