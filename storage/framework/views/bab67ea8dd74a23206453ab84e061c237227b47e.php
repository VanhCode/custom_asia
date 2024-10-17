<?php if($data->active==1): ?>
<a class="btn btn-sm btn-success lb-active" data-value="<?php echo e($data->active); ?>" data-type="<?php echo e($type?$type:''); ?>"  style="width:50px;">Hiện</a>
<?php elseif($data->active == 2): ?>
<a class="btn btn-sm btn-warning lb-active" data-value="<?php echo e($data->active); ?>" data-type="<?php echo e($type?$type:''); ?>"  style="width:50px;">Nháp</a>
<?php elseif($data->active == 0): ?>
<a class="btn btn-sm btn-info lb-active" data-value="<?php echo e($data->active); ?>" data-type="<?php echo e($type?$type:''); ?>"  style="width:50px;">Ẩn</a>
<?php endif; ?>

<?php /**PATH C:\laragon\www\demo22\resources\views/admin/components/load-change-active.blade.php ENDPATH**/ ?>