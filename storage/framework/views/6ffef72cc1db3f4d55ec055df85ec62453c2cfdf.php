

<?php $__env->startSection('title', 'List service type'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', [
            'name' => 'Service type',
            'key' => 'List service type',
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

                        <div class="text-right">
                            <a href="<?php echo e(route('admin.service-type.create')); ?>" class="custom-btn create">Thêm mới</a>
                        </div>


                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Service type</th>
                                                <th>Order</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($serviceTypes) && $serviceTypes->count() > 0): ?>
                                                <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td><?php echo e($item->name); ?></td>
                                                        <td>
                                                            <input type="number" id="order-quantity"
                                                                class="form-control number-input change-order"
                                                                data-url="<?php echo e(route('admin.service-type.changeOrder', ['id' => $item->id])); ?>"
                                                                data-method="PATCH" placeholder="0"
                                                                value="<?php echo e($item->order); ?>" min="0">
                                                        </td>
                                                        <td>
                                                            <button
                                                                data-url="<?php echo e(route('admin.service-type.changeActive', ['id' => $item->id])); ?>"
                                                                data-method="PATCH"
                                                                class="btn btn-danger change-active <?php echo e($item->active ? 'active' : ''); ?>"><?php echo e($item->active ? 'Active' : 'Hide'); ?></button>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo e(route('admin.service-type.edit', ['service_type' => $item->id])); ?>"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button
                                                                data-url="<?php echo e(route('admin.service-type.destroy', ['service_type' => $item->id])); ?>"
                                                                class="btn btn-sm btn-danger delete-record"
                                                                data-method="DELETE">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center p-3">No data</td>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <?php echo e($serviceTypes->links()); ?>

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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/service-type/index.blade.php ENDPATH**/ ?>