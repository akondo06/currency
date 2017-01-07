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
				<a class="navbar-brand navbar-left" href="<?php echo e(urlFor('index')); ?>">Curs Valutar</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li <?php echo isRoute('index'); ?>><a href="<?php echo e(urlFor('index')); ?>">Acasa</a></li>
					<li <?php echo isRoute('currency-converter'); ?>><a href="<?php echo e(urlFor('currency-converter')); ?>">Convertor Valutar</a></li>
					<li <?php echo isRoute('currency-evolution'); ?>><a href="<?php echo e(urlFor('currency-evolution')); ?>">Evolutie Curs</a></li>
					
					<li <?php echo isRoute(['history', 'onDate']); ?>><a href="<?php echo e(urlFor('history')); ?>">Istoric Curs Valutar</a></li>
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
				<?php $__currentLoopData = ratesOnDate(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<div class="currency" title="<?php echo e($rate->currency); ?>">
					<span class="flag <?php echo e(strtolower($rate->currency)); ?>"></span>
					<span class="value"><?php echo e(roNumber($rate->converted_value, 2)); ?> RON</span>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</div>
		</div>
	</nav>
</header>
