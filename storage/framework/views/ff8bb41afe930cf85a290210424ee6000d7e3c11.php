<?php if($numberDay > 0 && count($listDateNext) > 0): ?>
    <?php for($i = 0; $i < $numberDay; $i++): ?>
        <li class="day-box" data-target="day-box-<?php echo e($i + 1); ?>-<?php echo e($randoms[0]); ?>"
            data-date="<?php echo e($listDateNext[$i]); ?>" data-day="<?php echo e($day_start + $i); ?>">
            <span>Day <?php echo e($day_start + $i); ?></span>
            [<?php echo e($listDateNext[$i]); ?>]
        </li>
    <?php endfor; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\demo22\resources\views/admin/components/my-trip/day.blade.php ENDPATH**/ ?>