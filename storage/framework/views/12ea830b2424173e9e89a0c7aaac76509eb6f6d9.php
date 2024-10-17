<?php if($listDay->count() > 0): ?>
    <?php $__currentLoopData = $listDay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $itemDay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="wrap-list-option-ad" data-target="day-box-<?php echo e($i + 1); ?>-<?php echo e($randoms[0]); ?>">
            <span>Day <?php echo e($day_start + $i); ?></span>
            <input type="hidden" name="day_order[]" value="<?php echo e($day_start + $i); ?>" />
            <input type="hidden" name="day_time[]" value="<?php echo e($listDateNext[$i]); ?>" />
            [<?php echo e($listDateNext[$i]); ?>]
            <input type="text" class="w-100" value="<?php echo e($itemDay->name ?? ''); ?>" name="day_title[]" />

        </li>
        <div class="list-tour-ad-desc d-none" id="day-box-<?php echo e($i + 1); ?>-<?php echo e($randoms[0]); ?>">
            <div class="desc">
                <textarea class="w-100" name="day_description[]">
                    <?php echo e($itemDay->description ?? ''); ?>

        </textarea>
            </div>
            <?php
                $count = 1;
            ?>
            <div class="row">
                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                    <div class="check-img" id="content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-wrapper">
                        <img class="d-block img-filemanager img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>"
                            data-class="content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>"
                            src="<?php echo e($itemDay->image_path1 ?? asset('images/add-icon.png')); ?>"
                            alt="<?php echo e($itemDay->image_path1 ?? asset('images/add-icon.png')); ?>">
                        <div style="display: none">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-input"
                                        data-preview="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>"
                                        class="btn btn-primary"
                                        id="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-input"
                                    class="form-control" type="text" name="day_image_path1[]"
                                    value="<?php echo e($itemDay->image_path1 ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $count++;
                ?>
                <div class="clm" style="--w-lg: 6; --w-xs: 12;">

                    <div class="check-img" id="content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-wrapper">
                        <img class="d-block img-filemanager img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>"
                            src="<?php echo e($itemDay->image_path2 ?? asset('images/add-icon.png')); ?>"
                            alt="<?php echo e($itemDay->image_path2 ?? asset('images/add-icon.png')); ?>"
                            data-class="content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>">
                        <div style="display: none">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-input"
                                        data-preview="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>"
                                        class="btn btn-primary"
                                        id="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="img-content<?php echo e($day_start + $i); ?>-<?php echo e($count); ?>-input"
                                    class="form-control" type="text" name="day_image_path2[]"
                                    value="<?php echo e($itemDay->image_path2 ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <table class="w-100">

                <thead>
                    <tr>
                        <th style="width: 45px;" class="btn-add-option" data-day="<?php echo e($day_start + $i); ?>">+</th>
                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                        <th class="ta-center tt-up">Tên gói</th>
                        <th class="ta-center tt-up">Tổng giá</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($itemDay->tourDayOptions()->count() > 0): ?>
                        <?php $__currentLoopData = $itemDay->tourDayOptions()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourDayOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ta-center remove-btn " data-remove="service-all-price-<?php echo e($randoms[$i]); ?>"
                                    style="cursor: pointer">-</td>
                                <td>
                                    <select class="my-select select2 select2-<?php echo e($randoms[$i]); ?>" style="width: 100%;"
                                        name="day_service[<?php echo e($day_start + $i); ?>][]">
                                        <option value=""></option>
                                        <?php $__currentLoopData = $servicesOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicesOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($tourDayOption->parent_service_id == $servicesOption->id): ?> selected <?php endif; ?>
                                                value="<?php echo e($servicesOption->id); ?>"><?php echo e($servicesOption->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td class="ta-center service-all-2">
                                    <select class="my-select select2 select2-child-<?php echo e($randoms[$i]); ?>"
                                        style="width: 100%;" name="day_service_child[<?php echo e($day_start + $i); ?>][]">
                                        <option value=""></option>
                                        <?php
                                            $servicesOptionsChild = \App\Models\Service::where(
                                                'parent_id',
                                                $tourDayOption->parent_service_id,
                                            )->get();
                                        ?>
                                        <?php if($servicesOptionsChild->count() > 0): ?>
                                            <?php $__currentLoopData = $servicesOptionsChild; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicesOptionChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($servicesOptionChild->id == $tourDayOption->service_id): ?> selected <?php endif; ?>
                                                    value="<?php echo e($servicesOptionChild->id); ?>">
                                                    <?php echo e($servicesOptionChild->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <?php
                                    $option = \App\Models\ServiceOption::find($tourDayOption->option_id);
                                    $listOption = \App\Models\ServiceOption::where(
                                        'service_season_id',
                                        $option->service_season_id,
                                    )->get();
                                ?>
                                <td class="ta-center">
                                    <select class="my-select select2 select2-child-2-<?php echo e($randoms[$i]); ?>"
                                        style="width: 100%;" name="day_service_option[<?php echo e($day_start + $i); ?>][]">
                                        <option value=""></option>
                                        <?php if($listOption->count() > 0): ?>
                                            <?php $__currentLoopData = $listOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($item->id == $tourDayOption->option_id): ?> selected <?php endif; ?>
                                                    value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <td class="ta-center service-price service-all-price-<?php echo e($randoms[$i]); ?> price-tour-box-2-<?php echo e($option->service_type_id); ?>"
                                    data-price="<?php echo e($option->price); ?>" data-type="2"
                                    data-class="price-tour-box-2-<?php echo e($option->service_type_id); ?>"
                                    data-type="<?php echo e($option->service_type_id); ?>">
                                    <?php echo e(number_format($option->price, 0, ',', '.')); ?> VND</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/admin/components/my-trip/day-content.blade.php ENDPATH**/ ?>