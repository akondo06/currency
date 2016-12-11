<header>
		<nav class="navbar navbar-default navbar-with-ad">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand navbar-left" href="<?php echo e(urlFor('index')); ?>">Curs Valutar</a>
					<div class="ad size-728x90 navbar-right"></div>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li <?php echo isRoute('index'); ?>><a href="<?php echo e(urlFor('index')); ?>">Acasa</a></li>
						<li <?php echo isRoute('currency-converter'); ?>><a href="<?php echo e(urlFor('currency-converter')); ?>">Convertor Valutar</a></li>
						<li <?php echo isRoute('currency-evolution'); ?>><a href="<?php echo e(urlFor('currency-evolution')); ?>">Evolutie Curs</a></li>
						
						<li <?php echo isRoute('history'); ?>><a href="<?php echo e(urlFor('history')); ?>">Istoric Curs Valutar</a></li>
					</ul>
				</div>
			</div>
		</nav>
</header>