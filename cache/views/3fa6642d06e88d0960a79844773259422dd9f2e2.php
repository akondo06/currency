<?php $__env->startSection('content'); ?>
	<h2>Content of page <?php echo e($name); ?> m8!</h2>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.two-columns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>