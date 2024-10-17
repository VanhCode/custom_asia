
<?php $__env->startSection('title', 'Sửa thuộc tính'); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <?php echo $__env->make('admin.partials.content-header', ['name' => 'Thuộc tính', 'key' => 'Sửa thuộc tính'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(session('alert')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('alert')); ?>

                            </div>
                        <?php elseif(session('error')): ?>
                            <div class="alert alert-warning">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.attribute.update', ['id' => $data->id])); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-tool p-3 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                        <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin thuộc tính</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <ul class="nav nav-tabs">
                                                <?php $__currentLoopData = $langConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?php echo e($langItem['value'] == $langDefault ? 'active' : ''); ?>"
                                                            data-toggle="tab"
                                                            href="#tong_quan_<?php echo e($langItem['value']); ?>"><?php echo e($langItem['name']); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php $__currentLoopData = $langConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div id="tong_quan_<?php echo e($langItem['value']); ?>"
                                                        class="p-3 tab-pane <?php echo e($langItem['value'] == $langDefault ? 'active show' : ''); ?> fade">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label"
                                                                    for="">Tên</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text"
                                                                        class="form-control nameChangeSlug
                                                        <?php $__errorArgs = ['name_' . $langItem['value']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                        id="name_<?php echo e($langItem['value']); ?>"
                                                                        value="<?php echo e(old('name_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->name); ?>"
                                                                        name="name_<?php echo e($langItem['value']); ?>"
                                                                        placeholder="Nhập tên">
                                                                    <?php $__errorArgs = ['name_' . $langItem['value']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <div class="invalid-feedback d-block">
                                                                            <?php echo e($message); ?></div>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin khác</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <div class="form-group">
                                                <label class="control-label" for="">Chọn danh mục</label>
                                                <select
                                                    class="form-control custom-select select-2-init 
                                                    <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="" value="<?php echo e(old('parent_id')); ?>" name="parent_id">
                                                    <option value="0">--- Root---</option>
                                                    <?php if(old('parent_id') || old('parent_id') === '0'): ?>
                                                        <?php echo \App\Models\Attribute::getHtmlOptionAddWithParent(old('parent_id')); ?>

                                                    <?php else: ?>
                                                        <?php echo $option; ?>

                                                    <?php endif; ?>
                                                </select>
                                                <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            

                                            <div class="wrap-load-image mb-3">
                                                <?php
                                                    $randomId = random_int(1, 999999);
                                                ?>
                                                <div class="form-group">
                                                    <label for="">Ảnh đại diện</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="image_<?php echo e($randomId); ?>"
                                                                data-input="btn-remove-<?php echo e($randomId); ?>"
                                                                data-preview="image_pr"
                                                                class="btn btn-primary btn-file-manager">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="btn-remove-<?php echo e($randomId); ?>"
                                                            class="form-control input-file-change" type="text"
                                                            name="image" value="<?php echo e($data->image ?? ''); ?>">
                                                    </div>
                                                </div>
                                                <div class="btn-remove-<?php echo e($randomId); ?>-preview">
                                                    <?php if($data->image): ?>
                                                        <div class="form-group__img preview-avatar" data-name="image"
                                                            data-delete="">
                                                            <img src="<?php echo e($data->image); ?>">
                                                            <div class="form-group__delete delete-avatar"
                                                                id="btn-remove-<?php echo e($randomId); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome    - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path
                                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <img class="img-load border p-1 w-100"
                                                            src="<?php echo e(asset('admin_asset/images/upload-image.png')); ?>"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    <?php endif; ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Số thứ tự</label>

                                                <input type="number" min="0"
                                                    class="form-control  <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('order') ?? $data->order); ?>" name="order"
                                                    placeholder="Nhập số thứ tự">

                                                <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Trạng thái</label>

                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="1"
                                                            name="active"
                                                            <?php if(old('active') === '1' || old('active') === null): ?> <?php echo e('checked'); ?> <?php endif; ?>>Hiện
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="0"
                                                            <?php if(old('active') === '0'): ?> <?php echo e('checked'); ?> <?php endif; ?>
                                                            name="active">Ẩn
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/admin/pages/attribute/edit.blade.php ENDPATH**/ ?>