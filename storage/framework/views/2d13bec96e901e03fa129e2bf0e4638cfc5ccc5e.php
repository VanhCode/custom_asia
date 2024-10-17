
<?php $__env->startSection('title',"Danh sach setting"); ?>
<?php $__env->startSection('css'); ?>
<style>
    .lb_list_action_recusive{
        width: 170px;
    }
    .lb_list_content_recusive {
        width: calc(100% - 170px);
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <?php echo $__env->make('admin.partials.content-header',['name'=>"Setting","key"=>"Danh sách nội dung"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                <div class="text-right">
                    <a href="<?php echo e(route('admin.setting.create',['parent_id'=>request()->parent_id??0])); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                </div>

                <?php if(isset($parentBr)&&$parentBr): ?>
                <ol class="breadcrumb">
                  <li><a href="<?php echo e(route('admin.setting.index',['parent_id'=>0])); ?>">Root</a></li>

                  <?php $__currentLoopData = $parentBr->breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <li><a href="<?php echo e(route('admin.setting.index',['parent_id'=>$item['id']])); ?>"><?php echo e($item['name']); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo e(route('admin.setting.index',['parent_id'=>$parentBr->id])); ?>"><?php echo e($parentBr->name); ?></a></li>
                </ol>
                <?php endif; ?>

                 <div class="card card-outline card-primary">
                    <div class="card-body table-responsive lb-list-category">
                        <?php echo $__env->make('admin.components.setting', [
                            'data' => $data,
                            'routeNameEdit'=>'admin.setting.edit',
                            'routeNameAdd'=>'admin.setting.create',
                            'routeNameDelete'=>'admin.setting.destroy',
                            'routeNameOrder'=>'admin.loadOrderVeryModel',
                            'table'=>'settings',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <?php echo e($data->appends(request()->all())->links()); ?>

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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/admin/pages/setting/list.blade.php ENDPATH**/ ?>