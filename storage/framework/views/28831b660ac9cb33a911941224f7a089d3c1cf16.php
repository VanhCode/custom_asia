

  <ol class="breadcrumb mb-0">
    <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($loop->last): ?>
    <li class="breadcrumb-item active "><?php echo e($item['name']); ?></li>
    <?php else: ?>
    <li class="breadcrumb-item"><a href="#"><?php echo e($item['name']); ?></a></li>
    <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ol>

<?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/admin/components/breadcrumbs.blade.php ENDPATH**/ ?>