<?php $__env->startSection('title',"Danh sánh slider"); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper lb_template_list_slider">

    <?php echo $__env->make('admin.partials.content-header',['name'=>"Slider","key"=>"Danh sách slider"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                <a href="<?php echo e(route('admin.slider.create')); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                 <div class="card card-outline card-primary">
                    <div class="card-body table-responsive p-0 lb-list-category">
                        <table class="table table-head-fixed" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    
                                    <th class="white-space-nowrap ">Mô tả</th>
                                     <th class="white-space-nowrap">Hình ảnh</th>
                                     <th class="white-space-nowrap">Hiển thị</th>
                                    <th style="width:150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sliderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index); ?></td>
                                    <td><?php echo e($sliderItem->id); ?></td>
                                    <td><?php echo e($sliderItem->name); ?></td>
                                    
                                    <td class="w-50"><?php echo e($sliderItem->description); ?></td>
                                    <td><img src="<?php echo e(asset($sliderItem->image_path)); ?>" alt="<?php echo e($sliderItem->name); ?>" style="width:80px;"></td>
                                    <td class="wrap-load-active" data-url="<?php echo e(route('admin.slider.load.active',['id'=>$sliderItem->id])); ?>">
                                        <?php echo $__env->make('admin.components.load-change-active',['data'=>$sliderItem,'type'=>'slider'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                     </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.slider.edit',['id'=>$sliderItem->id])); ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <a data-url="<?php echo e(route('admin.slider.destroy',['id'=>$sliderItem->id])); ?>" class="btn btn-sm btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/slider/list.blade.php ENDPATH**/ ?>