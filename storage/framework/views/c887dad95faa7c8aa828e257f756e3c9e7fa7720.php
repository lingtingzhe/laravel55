<?php echo $__env->make("test/header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
hai




<hr>
现在时间是：
<?php echo e(date("Y-m-d H:i:s")); ?>


<hr>
<html>
11111
</html>


<hr>





<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent("test/zhanwei"); ?>

    section 中间的位置
<?php $__env->stopSection(); ?>

<hr>

ssss

<?php echo e($name); ?>

<?php echo e($age); ?>

<?php echo e($sex); ?>


<?php echo $__env->make("test.foot", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make("test/header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>