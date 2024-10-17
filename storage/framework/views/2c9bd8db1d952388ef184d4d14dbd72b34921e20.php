

<?php $__env->startSection('title', 'List service option'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
    <style>
        .box-service-wrap {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            margin-bottom: 10px;
        }

        .box-service-option {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .box-service-option.title {
            padding: 5px;
            background-color: bisque
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        


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

                        <h3 class="mt-3"><?php echo e($service->name); ?></h3>

                        

                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <?php if($service->seasons->count() > 0): ?>
                                    <?php $__currentLoopData = $service->seasons()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="box-service-wrap">
                                            <div class="box-service-option title">
                                                <div>
                                                    <?php echo e($item->name); ?>

                                                    (<?php echo e(\Carbon::parse($item->date_from)->format('d/m/Y')); ?> -
                                                    <?php echo e(\Carbon::parse($item->date_to)->format('d/m/Y')); ?>)
                                                </div>
                                                <div class="d-flex">
                                                    <button class="btn btn-warning mx-2 trigger-modal-btn"
                                                        data-type="update" data-id="<?php echo e($item->id); ?>"
                                                        data-name="<?php echo e($item->name); ?>"
                                                        data-date_from="<?php echo e($item->date_from); ?>"
                                                        data-date_to="<?php echo e($item->date_to); ?>"
                                                        data-url="<?php echo e(route('admin.service-season.update', ['service_season' => $item->id])); ?>">Update</button>
                                                    <button class="btn btn-danger delete-record"
                                                        data-url="<?php echo e(route('admin.service-season.destroy', ['service_season' => $item->id])); ?>"
                                                        data-method="DELETE">Delete</button>
                                                </div>
                                            </div>
                                            <div class="box-service-option content">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $item->services()->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($index + 1); ?></td>
                                                                <td><?php echo e($option->name); ?></td>
                                                                <td><?php echo e(number_format($option->price)); ?></td>
                                                                <td><?php echo e($option->type); ?></td>
                                                                <td>
                                                                    <a href="<?php echo e(route('admin.service-option.edit', ['service_option' => $option->id])); ?>"
                                                                        class="btn btn-warning delete-record-option">Edit</a>
                                                                    <button
                                                                        data-url="<?php echo e(route('admin.service-option.destroy', ['service_option' => $option->id])); ?>"
                                                                        data-method="DELETE"
                                                                        class="btn btn-danger delete-record">Delete</button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td colspan="5" style="cursor: pointer">
                                                                <a
                                                                    href="<?php echo e(route('admin.service-option.create', ['service_id' => $service->id, 'service_season_id' => $item->id])); ?>">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="no-data-message">
                                        No data available
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="px-3">
                                <button class="trigger-modal-btn" data-type="create">Create
                                    Season</button>
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

    <!-- Modal -->
    <div class="custom-modal-overlay" id="custom-modal">
        <form id="customForm" action="<?php echo e(route('admin.service-season.store', ['service_id' => $service->id])); ?>"
            method="POST" data-type="create">
            <div class="custom-modal">
                <div class="custom-modal-header">
                    <h2 class="custom-modal-title">Create Season</h2>
                    <span class="custom-close-btn">&times;</span>
                </div>
                <div class="custom-modal-body">
                    <div class="form-group">
                        <label for="name">Name Season:</label>
                        <input type="text" id="name" name="name" class="custom-input"
                            placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="date_from">Season Date From:</label>
                        <input type="date" id="date_from" name="date_from" class="custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="date_to">Season Date To:</label>
                        <input type="date" id="date_to" name="date_to" class="custom-input" required>
                    </div>

                </div>
                <div class="custom-modal-footer">
                    <button type="submit" class="custom-btn custom-btn-confirm">Xác nhận</button>
                    <button class="custom-btn custom-btn-cancel">Hủy</button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('custom/js/main.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/service-option/index.blade.php ENDPATH**/ ?>