<?php $__env->startSection('aside'); ?> 
	<div class="panel panel-default">
		<div class="panel-heading">Convertor Rapid</div>
		<div class="panel-body">
			<form>
			<p>Calculeaza conform <b>cursului valutar BNR</b> din <b>28 Octombrie 2016</b>:</p>

			<div class="form-group">
				<label for="convert-from">Transforma din:</label>
				<select name="convert-from" id="convert-from" class="form-control input-sm">
					<?php $__currentLoopData = \App\Models\Rate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<?php if($rate->currency == "EUR"): ?>
							<option label="<?php echo e($rate->title()); ?>" value="<?php echo e($rate->currency); ?>" selected="selected"><?php echo e($rate->title()); ?></option>
						<?php else: ?>
							<option label="<?php echo e($rate->title()); ?>" value="<?php echo e($rate->currency); ?>"><?php echo e($rate->title()); ?></option>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</select>
			</div>
			<div class="form-group">
				<label for="convert-to">in:</label> <i class="fa fa-refresh" id="switch-conversion"></i>
				<select name="convert-to" id="convert-to" class="form-control input-sm">
					<?php $__currentLoopData = \App\Models\Rate::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<?php if($rate->currency == "RON"): ?>
							<option label="<?php echo e($rate->title()); ?>" value="<?php echo e($rate->currency); ?>" selected="selected"><?php echo e($rate->title()); ?></option>
						<?php else: ?>
							<option label="<?php echo e($rate->title()); ?>" value="<?php echo e($rate->currency); ?>"><?php echo e($rate->title()); ?></option>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</select>
			</div>

			<div class="form-group amount">
				<label for="amount">Suma:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-money"></i></div>
					<input type="text" id="amount" class="form-control input-sm">
				</div>
				<i class="fa fa-share"></i>
			</div>

			<div class="form-group result">
				<label for="result">Rezultat:</label>
				<input type="text" id="result" class="form-control input-sm" value="0">
			</div>
			<div class="form-group result collapse" style="">
				<label for="result">Rezultat cu TVA 20%:</label>
				<input type="text" id="result-with-vat" class="form-control input-sm" value="0">
			</div>
			<div class="form-group result collapse" style="">
				<label for="result">Valoare TVA 20%:</label>
				<input type="text" id="vat" class="form-control input-sm" value="0">
			</div>
		</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			300x250 ad
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Stiri</div>
		<div class="panel-body">
			Ceva stiri aici ... poate?
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			facebook widget
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?php echo $__env->yieldContent('aside'); ?>
			</div>
			<div class="col-md-9">
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>