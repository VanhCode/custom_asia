<?php $__env->startSection('title',"danh sach nhân viên"); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('lib/sweetalert2/css/sweetalert2.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <?php echo $__env->make('admin.partials.content-header',['name'=>" Admin User","key"=>"Danh sách admin user"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if(session("alert")): ?>
                <div class="alert alert-success">
                    <?php echo e(session("alert")); ?>

                </div>
                <?php elseif(session('error')): ?>
                <div class="alert alert-warning">
                    <?php echo e(session("error")); ?>

                </div>
                <?php endif; ?>
                <a href="<?php echo e(route('admin.user.create')); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                <div class="card card-outline card-primary">
                    <div class="card-body table-responsive p-0 lb-list-category">
                        <table class="table table-head-fixed" style="font-size:13px;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Ảnh</th>
                                    <th>Giới thiệu</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adminItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index); ?></td>
                                    <td><?php echo e($adminItem->id); ?></td>
                                    <td><?php echo e($adminItem->name); ?></td>
                                    <td><?php echo e($adminItem->email); ?></td>
                                    <td><img style="height: 40px" src="<?php echo e($adminItem->avatar_path); ?>" alt="<?php echo e($adminItem->name); ?>"></td>
                                    <td><?php echo e($adminItem->description); ?></td>
                                    

                                    <td>
                                        <a href="<?php echo e(route('admin.user.edit',['id'=>$adminItem->id])); ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <?php if($adminItem->id != Auth::guard('admin')->user()->id): ?>
                                        <a data-url="<?php echo e(route('admin.user.destroy',['id'=>$adminItem->id])); ?>" class="btn btn-sm btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo e($data->links()); ?>

            </div>
        </div>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('lib/sweetalert2/js/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_asset/ajax/deleteAdminAjax.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/user/list.blade.php ENDPATH**/ ?>