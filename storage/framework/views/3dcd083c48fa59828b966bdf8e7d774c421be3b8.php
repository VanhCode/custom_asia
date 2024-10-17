
<?php $__env->startSection('title',"Danh sách vai trò"); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <?php echo $__env->make('admin.partials.content-header',['name'=>"Vai trò","key"=>"Danh sách vai trò"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                <a href="<?php echo e(route('admin.role.create')); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>

                <div class="card card-outline card-primary">
                    <div class="card-body table-responsive p-0 lb-list-category">
                        <table class="table table-head-fixed" style="font-size:13px;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($roleItem->id != 1): ?>
                                <tr>
                                    <td><?php echo e($loop->index); ?></td>
                                    <td><?php echo e($roleItem->id); ?></td>
                                    <td><?php echo e($roleItem->name); ?></td>
                                    <td><?php echo e($roleItem->description); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.role.edit',['id'=>$roleItem->id])); ?>" class="btn btn-sm  btn-success"><i class="fas fa-edit"></i></a>
                                        <a data-url="<?php echo e(route('admin.role.destroy',['id'=>$roleItem->id])); ?>" class="btn btn-sm  btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/role/list.blade.php ENDPATH**/ ?>