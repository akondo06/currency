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
					<a class="navbar-brand" href="<?php echo e(urlFor('index')); ?>">Curs Valutar</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo e(urlFor('currency-converter')); ?>">Convertor Valutar</a></li>
						<li><a href="<?php echo e(urlFor('currency-evolution')); ?>">Evolutie Curs</a></li>
						
						<li><a href="<?php echo e(urlFor('history')); ?>">Istoric Curs Valutar</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>