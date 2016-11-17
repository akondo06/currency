<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs EUR din ultimele 3 luni</div>
				<div class="panel-body no-padding" id="chartdiv">
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Grafic evolutie curs USD din ultimele 3 luni</div>
				<div class="panel-body">
					GRAF ACI <br />
					https://www.amcharts.com/demos/zoomable-value-axis/ <br />
					http://www.curs-valutar-bnr.ro/
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Cursul BNR afisat astazi <?php echo e(date('d F Y')); ?> a fost licitat de catre BNR in data de: <?php echo e(date('d F Y', strtotime($rateValues[0]->published_on))); ?>, raportat la <?php echo e($rate->title()); ?></div>
				<div class="panel-body">
					<pre style="height: 600px;">
						<?php echo e($rateValues); ?>

						<?php echo e($queries); ?>

					</pre>
					<form class="form-inline" method="post">
						<div class="form-group">
							<label for="datepicker">Afiseaza curs BNR din data de:</label>
							<input type="text" name="index_date" value="<?php echo e($index_date); ?>" class="form-control input-sm datepicker" id="datepicker" />
						</div>
						<div class="form-group">
							<label for="index_currency">raportat la</label>
							<select name="index_currency" id="index_currency" class="form-control input-sm">
								<?php $__currentLoopData = \App\Models\Currency::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php if($r->currency == $rate->currency): ?>
										<option label="<?php echo e($r->title()); ?>" value="<?php echo e($r->currency); ?>" selected="selected"><?php echo e($r->title()); ?></option>
									<?php else: ?>
										<option label="<?php echo e($r->title()); ?>" value="<?php echo e($r->currency); ?>"><?php echo e($r->title()); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
						</div>
					</form>
				</div>
				<table class="table table-hover">
					<thead>
						<th>#</th>
						<th>Simbol</th>
						<th>Denumire valuta</th>
						<th>Azi</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.two-columns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>