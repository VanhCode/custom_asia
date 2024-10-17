

<?php $__env->startSection('title', 'List service full tour'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', [
            'name' => 'Service',
            'key' => 'List service full tour',
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
                            <?php if(request()->parent_id): ?>
                                <a href="<?php echo e(route('admin.service-full.index', ['parent_id' => 0])); ?>"
                                    class="custom-btn yellow mx-2">Go back</a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.service-full.create', ['parent_id' => request()->parent_id ?? 0])); ?>"
                                class="custom-btn create">Thêm mới</a>
                        </div>


                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <?php if($parent): ?>
                                    <h4><?php echo e($parent->name); ?></h4>
                                <?php endif; ?>
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Folder</th>
                                                <th>Service</th>
                                                <th>Order</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($services) && $services->count() > 0): ?>
                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td>
                                                            <?php if($item->children->count()): ?>
                                                                <i class="fas fa-folder"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-file-alt"></i>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?php echo e(route('admin.service-full.index', ['parent_id' => $item->id])); ?>">
                                                                <?php echo e($item->name); ?>

                                                            </a>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="order-quantity"
                                                                class="form-control number-input change-order"
                                                                data-url="<?php echo e(route('admin.service-full.changeOrder', ['id' => $item->id])); ?>"
                                                                data-method="PATCH" placeholder="0"
                                                                value="<?php echo e($item->order); ?>" min="0">
                                                        </td>
                                                        <td>
                                                            <button
                                                                data-url="<?php echo e(route('admin.service-full.changeActive', ['id' => $item->id])); ?>"
                                                                data-method="PATCH"
                                                                class="btn btn-danger change-active <?php echo e($item->active ? 'active' : ''); ?>"><?php echo e($item->active ? 'Active' : 'Hide'); ?></button>
                                                        </td>
                                                        <td>
                                                            <?php if(request()->parent_id): ?>
                                                                <a href="<?php echo e(route('admin.service-full-option.index', ['service_id' => $item->id])); ?>"
                                                                    class="btn btn-sm btn-success">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(route('admin.service-full.edit', ['service_full' => $item->id, 'parent_id' => request()->parent_id ?? 0])); ?>"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button
                                                                data-url="<?php echo e(route('admin.service-full.destroy', ['service_full' => $item->id])); ?>"
                                                                class="btn btn-sm btn-danger delete-record"
                                                                data-method="DELETE">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center p-3">No data</td>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <?php echo e($services->links()); ?>

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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/service-full/index.blade.php ENDPATH**/ ?>