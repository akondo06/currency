<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Curs Valutar</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<link href="<?php echo e(trim(elixir('css/app.css'), '/')); ?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			var homeUrl = '<?php echo e(homeURL()); ?>';
			var currencies = {
				<?php $__currentLoopData = \App\Models\Currency::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<?php echo e($c->currency); ?>: '<?php echo e($c->currency); ?> - <?php echo e($c->name); ?>',
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			};
			var baseCurrency = 'RON';
		</script>
		<?php echo $__env->yieldContent('head'); ?>
	</head>
	<body>
		<div class="wrapper-main">
			<?php echo $__env->make('components.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<div class="content-main">
				<?php echo $__env->yieldContent('body'); ?>
			</div>
			<?php echo $__env->make('components.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.ro.min.js"></script>
	
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

		<?php echo $__env->yieldContent('scripts'); ?>
		<script type="text/javascript" src="<?php echo e(trim(elixir('js/app.js'), '/')); ?>"></script>
	</body>
</html>

<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
