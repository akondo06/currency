<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-1-currency">EUR</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<div class="chart-container small" id="chart1"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-2-currency">USD</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 2], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<div class="chart-container small" id="chart2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel-wrapper">
				<h3>Grafic evolutie curs <span class="chart-3-currency">GBP</span> din ultimele 3 luni</h3>
				<div class="panel panel-default">
					<div class="panel-body no-padding chart-wrapper">
						<?php echo $__env->make('components.currencies-dropdown', ['chart' => 3], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<div class="chart-container small" id="chart3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<?php echo $__env->make('components.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div class="col-md-9">
			<div class="panel-wrapper">
				<h3>Cursul BNR afisat in data de <?php echo e(roDate($rates[0]->published_on, 'long')); ?>, raportat la <?php echo e($currency->title()); ?></h3>
				<div class="panel panel-default panel-with-table-sm">
					<div class="panel-body">
						<form class="form-inline" method="post">
							<?php echo $__env->make('components.date-picker', ['id' => 'index_date', 'value' => $index_date, 'size' => 'sm', 'label' => 'Afiseaza curs BNR din data de:'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo $__env->make('components.currencies-select', ['id' => 'index_currency', 'selected' => $currency->currency, 'currencyAsValue' => true, 'size' => 'sm', 'label' => 'raportat la'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<div class="form-group">
								<input type="submit" name="display" value="update" class="btn btn-primary btn-sm">
							</div>
						</form>
					</div>
					<?php echo $__env->make('components.currencies-table', ['rates' => $rates, 'with_variation' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.one-column', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>