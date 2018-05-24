<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artilce|标题title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
</head>
<body>


<?php echo $__env->make('article.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->yieldContent('content'); ?>


<?php echo $__env->make('article.common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="http://ajax.useso.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</body>
</html>