<?php $__env->startSection('content'); ?>
    <div class="container" style="height: 500px;text-align: center;">
        <h1 style="position: absolute;left: 35%;top: 30%;">继承模板的主页搞定了！</h1>
        
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('article.common.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>