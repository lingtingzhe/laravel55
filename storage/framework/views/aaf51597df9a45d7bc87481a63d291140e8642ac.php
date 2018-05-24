<div>
	<div>
	<a href="<?php echo e(url('/testInsert')); ?>">添加数据</a>
		<table border="0">
			<tr>
				<th>id</th>
				<th>name</th>
				<th>age</th>
				<th>sex</th>
				<th>操作</th>
			</tr>
			<?php $__currentLoopData = $testList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($value['id']); ?>  </td> 
				<td><?php echo e($value['name']); ?></td>
				<td><?php echo e($value['age']); ?></td>
				<td><?php echo e($value['sex']); ?></td>
				<td> <a href="<?php echo e(url('/deleteInfo/'.$value['id'])); ?>">删除</a></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
		</table>
	</div>
</div>