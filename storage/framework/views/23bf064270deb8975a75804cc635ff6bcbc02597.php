<?php $__env->startSection('title', 'Danh sach thuộc tính'); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', [
            'name' => 'Thuộc tính',
            'key' => 'Danh sách thuộc tính',
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
                            <a href="<?php echo e(route('admin.attribute.create', ['parent_id' => request()->parent_id ?? 0])); ?>"
                                class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                        </div>
                        <div class="card card-outline card-info">
                            <div class="card-header pt-2 pb-2">
                                <div class="cart-title">
                                    <i class="fas fa-list"></i> Thuộc tính
                                </div>
                            </div>
                        </div>

                        <?php if(isset($parentBr) && $parentBr): ?>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo e(route('admin.attribute.index', ['parent_id' => 0])); ?>">Root</a></li>

                                <?php $__currentLoopData = $parentBr->breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a
                                            href="<?php echo e(route('admin.attribute.index', ['parent_id' => $item['id']])); ?>"><?php echo e($item['name']); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <li><a
                                        href="<?php echo e(route('admin.attribute.index', ['parent_id' => $parentBr->id])); ?>"><?php echo e($parentBr->name); ?></a>
                                </li>
                            </ol>
                        <?php endif; ?>
                        <div class="card card-outline card-primary">
                            <div class="card-body table-responsive lb-list-category">
                                




                                <ul class="lb_list_category">
                                    <li class="border-bottom font-weight-bold  title-card-recusive">
                                        <div class="d-flex">
                                            <div class="box-left lb_list_content_recusive">
                                                <div class="d-flex">
                                                    <div class="col-sm-1 pt-2 pb-2 white-space-nowrap folder">
                                                        #
                                                    </div>
                                                    <div class="col-sm-4 pt-2 pb-2 name">
                                                        Tên danh mục
                                                    </div>
                                                    <div class="col-sm-2 pt-2 pb-2 slug text-center">
                                                        Thứ tự

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="pt-2 pb-2 lb_list_action_recusive">
                                                Tác Vụ
                                            </div>
                                        </div>
                                    </li>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="lb_item_recusive font-weight-bold  lb_item_delete  border-bottom">
                                            <div class="d-flex">
                                                <div class="box-left lb_list_content_recusive ">
                                                    <div class="d-flex">
                                                        <div class="col-sm-1 pt-2 pb-2 white-space-nowrap folder">
                                                            
                                                            <?php if($value->childs->count()): ?>
                                                                <i class="fas fa-folder"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-file-alt"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-4 pt-2 pb-2 name">
                                                            <a
                                                                href="<?php echo e(route(Route::currentRouteName(), ['parent_id' => $value->id])); ?>"><?php echo e($value->name); ?></a>

                                                        </div>
                                                        <div class="col-sm-2 pt-2 pb-2 slug text-center">
                                                            <input
                                                                data-url="<?php echo e(route('admin.loadOrderVeryModel', ['table' => 'attributes', 'id' => $value->id])); ?>"
                                                                class="lb-order text-center" type="number" min="0"
                                                                value="<?php echo e($value->order ? $value->order : 0); ?>"
                                                                style="width:50px" />
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="pt-1 pb-1 lb_list_action_recusive">
                                                    <a href="<?php echo e(route('admin.attribute.edit', ['id' => $value->id])); ?>"
                                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                    <a href="<?php echo e(route('admin.attribute.create', ['parent_id' => $value->id])); ?>"
                                                        class="btn btn-sm btn-info">+ Thêm</a>
                                                    <a data-url="<?php echo e(route('admin.attribute.destroy', ['id' => $value->id])); ?>"
                                                        class="btn btn-sm btn-danger lb_delete_recusive"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    
                                                </div>
                                            </div>
                                            
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/admin/pages/attribute/list.blade.php ENDPATH**/ ?>