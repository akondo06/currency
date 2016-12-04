<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-1-currency">EUR</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
				<div class="panel-body no-padding">
					<div class="chart-container small" id="chart1"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-2-currency">USD</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 2], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
				<div class="panel-body no-padding">
					
					<div class="chart-container small" id="chart2"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Grafic evolutie curs <span class="chart-3-currency">GBP</span> din ultimele 3 luni</div>
					<div class="panel-actions">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 3], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
				<div class="panel-body no-padding">
					<div class="chart-container small" id="chart3"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Convertor Rapid</div>
				<div class="panel-body">
					<?php echo $__env->make('components.fast-converter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Cursul BNR afisat astazi <?php echo e(date('d F Y')); ?> a fost licitat de catre BNR in data de: <?php echo e(date('d F Y', strtotime($rates[0]->published_on))); ?>, raportat la <?php echo e($currency->title()); ?></div>
				<div class="panel-body">
					
					<form class="form-inline" method="post">
						<?php echo $__env->make('components.date-picker', ['id' => 'datepicker', 'value' => $index_date, 'size' => 'sm', 'label' => 'Afiseaza curs BNR din data de:'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php echo $__env->make('components.currencies-select', ['id' => 'index_currency', 'selected' => $currency->currency, 'size' => 'sm', 'label' => 'raportat la'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<div class="form-group">
							<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
						</div>
					</form>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<th>#</th>
						<th>Simbol</th>
						<th>Denumire valuta</th>
						<th><?php echo e($rates[0]->two_days_before->published_on); ?></th>
						<th><?php echo e($rates[0]->yesterday->published_on); ?></th>
						<th>Variatie</th>
						<th><?php echo e($rates[0]->published_on); ?></th>
					</thead>
					<tbody>
						<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<td><span class="flag <?php echo e(strtolower($rate->currency)); ?>"></span></td>
								<td><?php echo e($rate->currency); ?></td>
								<td><a href="<?php echo e(urlFor('currency', ['slug'=> $rate->currencyObj->slug])); ?>"><?php echo e($rate->currencyObj->name); ?></a></td>
								<td><?php echo e($rate->two_days_before->converted_value); ?></td>
								<td><?php echo e($rate->yesterday->converted_value); ?></td>
								<td><?php echo e($rate->variation()); ?></td>
								<td><?php echo e($rate->converted_value); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.one-column', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>