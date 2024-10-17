

<?php $__env->startSection('title', 'Update service'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', [
            'name' => 'Service',
            'key' => 'Update service',
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
                                        action="<?php echo e(route('admin.service.update', ['service' => $service->id])); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Service class:</label>
                                                <input type="text"
                                                    class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>"
                                                    id="name" placeholder="Service class"
                                                    value="<?php echo e(old('name') ?? $service->name); ?>" name="name">
                                                <?php if($errors->has('name')): ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($errors->first('name')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order">Order:</label>
                                                <input type="number"
                                                    class="form-control <?php if($errors->has('order')): ?> is-invalid <?php endif; ?>"
                                                    id="order" min="0" placeholder="Order" name="order"
                                                    value="<?php echo e(old('order') ?? $service->order); ?>">
                                                <?php if($errors->has('order')): ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($errors->first('order')); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="parent">Service parent:</label>
                                                <input type="text" disabled class="form-control" id="parent"
                                                    placeholder="No data" value="<?php echo e(isset($parent) ? $parent->name : ''); ?>">
                                                <input type="hidden" id="parent_id" name="parent_id"
                                                    value="<?php echo e(isset($parent) ? $parent->id : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label class="w-100">Status:</label>
                                                <div class="d-flex">
                                                    <div class="radio-group px-2">
                                                        <input type="radio" name="active" value="1"
                                                            id="status-active"
                                                            <?php if(old('active') === '1' || $service->active == 1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                        <label for="status-active">Active</label>
                                                    </div>
                                                    <div class="radio-group px-2">
                                                        <input type="radio" name="active" value="0" id="status-hide"
                                                            <?php if(old('active') === '0' || $service->active == 0): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                        <label for="status-hide">Hide</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="control-label" for="description">Description</label>
                                            <textarea name="description" id="description" class="ckeditor">
                                                <?php echo e(old('description') ?? $service->description); ?>

                                            </textarea>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end col-12">
                                            <a href="<?php echo e(route('admin.service.index', ['parent_id' => request()->parent_id ?? 0])); ?>"
                                                class="custom-btn yellow mx-2">Go back</a>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/service/edit.blade.php ENDPATH**/ ?>