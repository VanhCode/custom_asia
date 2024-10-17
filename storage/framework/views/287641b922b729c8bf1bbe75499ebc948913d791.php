

<?php $__env->startSection('title', 'Create service option'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', [
            'name' => 'Service option',
            'key' => 'Create service option',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <div>
                                    <form class="row"
                                        action="<?php echo e(route('admin.service-option.update', ['service_option' => $serviceOption->id])); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Service option:</label>
                                                <input type="text"
                                                    class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>"
                                                    id="name" placeholder="Service option"
                                                    value="<?php echo e(old('name') ?? $serviceOption->name); ?>" name="name">
                                                <?php if($errors->has('name')): ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($errors->first('name')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price:</label>
                                                <input type="number"
                                                    class="form-control <?php if($errors->has('price')): ?> is-invalid <?php endif; ?>"
                                                    id="price" min="0" placeholder="price" name="price"
                                                    value="<?php echo e(old('price') ?? $serviceOption->price); ?>">
                                                <?php if($errors->has('price')): ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($errors->first('price')); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="service_type_id">Service Type:</label>
                                                <select name="service_type_id" id="service_type_id"
                                                    class=" <?php if($errors->has('service_type_id')): ?> is-invalid <?php endif; ?>">
                                                    <?php $__currentLoopData = $servicesType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>"
                                                            <?php if($loop->first): ?> selected <?php endif; ?>
                                                            <?php echo e(old('service_type_id') ?? $serviceOption->service_type_id == $value->id ? 'selected' : ''); ?>>
                                                            <?php echo e($value->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('service_type_id')): ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($errors->first('service_type_id')); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type:</label>
                                                <input type="text"
                                                    class="form-control <?php if($errors->has('type')): ?> is-invalid <?php endif; ?>"
                                                    id="type" placeholder="Type"
                                                    value="<?php echo e(old('type') ?? $serviceOption->type); ?>" name="type">
                                                <?php if($errors->has('type')): ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($errors->first('type')); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="control-label" for="description">Description</label>
                                            <textarea name="description" id="description" class="ckeditor">
                                                <?php echo e(old('description') ?? $serviceOption->description); ?>

                                            </textarea>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end col-12">
                                            <a href="<?php echo e(url()->previous()); ?>" class="custom-btn yellow mx-2">Go back</a>
                                            <button type="submit" class="custom-btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('custom/js/main.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/service-option/edit.blade.php ENDPATH**/ ?>