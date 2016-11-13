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
				<div class="panel-heading">Cursul BNR afisat astazi <?php echo e(date('d F Y')); ?> a fost licitat de catre BNR in data de: <?php echo e(date('d F Y', strtotime($rateValues[0]->published_on))); ?>, raportat la <?php echo e($rate->currency_name); ?> (<?php echo e($rate->currency); ?>)</div>
				
				<table class="table table-hover">
					<thead>
						<th>#</th>
						<th>Simbol</th>
						<th>Denumire valuta</th>
						<th>Azi</th>
					</thead>
					<tbody>
						<?php $__currentLoopData = $rateValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<td><span class="flag <?php echo e(strtolower($rate->currency)); ?>"></span></td>
								<td><?php echo e($rate->currency); ?></td>
								<td><?php echo e($rate->rate->currency_name); ?></td>
								<td><?php echo e($rate->value); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.two-columns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>