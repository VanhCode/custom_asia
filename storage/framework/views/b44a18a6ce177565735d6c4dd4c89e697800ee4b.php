
<?php $__env->startSection('title', 'My Trips'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('admin_asset/css/utilities.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/style.css')); ?>">
    <style>
        i {
            cursor: pointer;
            font-size: 13px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', ['name' => 'My Trips', 'key' => 'My Trips'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main>
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
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Trip</th>
                                                    <th>Number adult</th>
                                                    <th>Customer Name</th>
                                                    <th>Number Day</th>
                                                    <th>Start Date</th>
                                                    <th>Total Cost</th>
                                                    <th>Total Cost/ Person</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($myTrips) && $myTrips->count() > 0): ?>
                                                    <?php $__currentLoopData = $myTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($item->tour_name); ?></td>
                                                            <td>
                                                                <?php echo e($item->adult_number); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e($item->title_name); ?> <?php echo e($item->first_name); ?>

                                                                <?php echo e($item->last_name); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e($item->day_number ?? '( No data )'); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(\Carbon::parse($item->date_start)->format('m/d/Y')); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(number_format($item->final_cost)); ?> VND
                                                            </td>
                                                            <td>
                                                                <?php echo e(number_format($item->final_cost_per_person)); ?> VND
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo e(route('admin.my-trip.edit', ['id' => $item->id])); ?>"
                                                                    class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button
                                                                    data-url="<?php echo e(route('admin.my-trip.destroy', ['id' => $item->id])); ?>"
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
                                        <?php echo e($myTrips->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
        </main>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('custom/js/main.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/admin/pages/my-trip/index.blade.php ENDPATH**/ ?>