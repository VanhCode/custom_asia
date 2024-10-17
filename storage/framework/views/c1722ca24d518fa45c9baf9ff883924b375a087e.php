<?php $__env->startSection('title', 'Danh sách Tour'); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('control'); ?>
    <a href="<?php echo e(route('admin.product.create')); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
<?php $__env->stopSection(); ?>
<?php
    if (session()->has('page')) {
        session()->forget('page');
    }

    session()->put('page', request()->query('page') ? request()->query('page') : 1);
?>
<?php $__env->startSection('content'); ?>
<style>
    .tour-message {
        background-color: #ffcccc;
        color: #ff0000;
        padding: 9px 10px;
        text-align: center;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 400;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 20px auto;
        border: 1px solid #f66;
    }
</style>
    <div class="content-wrapper lb_template_list_product">

        <?php echo $__env->make('admin.partials.content-header', ['name' => 'Tour', 'key' => 'Danh sách Tour'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <div class="d-flex justify-content-between ">
                            <a href="<?php echo e(route('admin.product.create')); ?>" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                            
                        </div>

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="card-tools w-100 mb-3">
                                    <form action="<?php echo e(route('admin.product.index')); ?>" method="GET">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="form-group col-md-3 mb-0">
                                                        <input id="keyword" value="<?php echo e($keyword); ?>" name="keyword"
                                                            type="text" class="form-control" placeholder="Từ khóa">
                                                        <div id="keyword_feedback" class="invalid-feedback">

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="order" name="order_with" class="form-control">
                                                            <option value="">-- Sắp xếp theo --</option>
                                                            <option value="dateASC"
                                                                <?php echo e($order_with == 'dateASC' ? 'selected' : ''); ?>>Ngày tạo
                                                                tăng
                                                                dần</option>
                                                            <option value="dateDESC"
                                                                <?php echo e($order_with == 'dateDESC' ? 'selected' : ''); ?>>Ngày tạo
                                                                giảm
                                                                dần</option>
                                                            <option value="viewASC"
                                                                <?php echo e($order_with == 'viewASC' ? 'selected' : ''); ?>>Lượt xem
                                                                tăng
                                                                dần</option>
                                                            <option value="viewDESC"
                                                                <?php echo e($order_with == 'viewDESC' ? 'selected' : ''); ?>>Lượt xem
                                                                giảm
                                                                dần</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="" name="fill_action" class="form-control">
                                                            <option value="">-- Lọc --</option>
                                                            <option value="hot"
                                                                <?php echo e($fill_action == 'hot' ? 'selected' : ''); ?>>Tour hot
                                                            </option>
                                                            <option value="no_hot"
                                                                <?php echo e($fill_action == 'no_hot' ? 'selected' : ''); ?>>Tour
                                                                không
                                                                hot</option>
                                                            <option value="active"
                                                                <?php echo e($fill_action == 'active' ? 'selected' : ''); ?>>Tour hiển
                                                                thị</option>
                                                            <option value="no_active"
                                                                <?php echo e($fill_action == 'no_active' ? 'selected' : ''); ?>>Tour bị
                                                                ẩn</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="categoryProduct" name="category" class="form-control">
                                                            <option value="">-- Tất cả danh mục --</option>
                                                            
                                                            <?php echo $option; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 mb-0">
                                                <button type="submit" class="btn btn-success w-100">Tìm</button>
                                            </div>
                                            <div class="col-md-1 mb-0">
                                                <a class="btn btn-danger w-100"
                                                    href="<?php echo e(route('admin.product.index')); ?>">Làm mới</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-tools text-right pl-3 pr-3 pt-2 pb-2">
                                <div class="count">
                                    Tổng số bản ghi <strong><?php echo e($data->count()); ?></strong> / <?php echo e($totalProduct); ?>

                                </div>
                            </div>
                            <div class="card-body table-responsive p-0 lb-list-category">
                                <table class="table table-head-fixed" style="font-size: 13px;">
                                    <thead>
                                        <tr>
                                            <th
                                                style="display: flex;
                                    align-items: center;
                                    justify-content: space-between;">
                                                <input type="checkbox" id="check_all">
                                                <div>
                                                    <button type="button" class="btn btn-danger btn-xs delete-all"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </div>
                                            </th>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            
                                            <th class="white-space-nowrap">Hình ảnh</th>
                                            <th class="white-space-nowrap">Active</th>
                                            <th class="white-space-nowrap">Nổi bật</th>
                                            <th class="white-space-nowrap">Danh mục</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkbox"
                                                        data-id="<?php echo e($productItem->id); ?>"></td>
                                                <td><?php echo e($loop->index); ?></td>
                                                <td><?php echo e($productItem->name); ?></td>
                                                
                                                <td>
                                                    <img src="<?php echo e($productItem->avatar_path ? asset($productItem->avatar_path) : $shareFrontend['noImage']); ?>"
                                                        alt="<?php echo e($productItem->name); ?>" style="width:80px;">
                                                </td>
                                                <td class="wrap-load-active"
                                                    data-url="<?php echo e(route('admin.product.load.active', ['id' => $productItem->id])); ?>">
                                                    <?php echo $__env->make('admin.components.load-change-active', [
                                                        'data' => $productItem,
                                                        'type' => 'Tour',
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </td>
                                                <td class="wrap-load-hot"
                                                    data-url="<?php echo e(route('admin.product.load.hot', ['id' => $productItem->id])); ?>">
                                                    <?php echo $__env->make('admin.components.load-change-hot', [
                                                        'data' => $productItem,
                                                        'type' => 'Tour',
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </td>
                                                <td><?php echo e(optional($productItem->category)->name); ?></td>
                                                <td>
                                                    
                                                    <a href="<?php echo e(route('admin.product.edit', ['id' => $productItem->id])); ?>"
                                                        class="btn btn-sm btn-info"
                                                        onclick="localStorage.setItem('urlListProduct', window.location.href);"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a data-url="<?php echo e(route('admin.product.destroy', ['id' => $productItem->id])); ?>"
                                                        class="btn btn-sm btn-danger lb_delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php echo e($data->appends(request()->input())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#check_all').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });

            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#check_all').prop('checked', true);
                } else {
                    $('#check_all').prop('checked', false);
                }
            });

            $('.delete-all').on('click', function(e) {
                var idsArr = [];

                $(".checkbox:checked").each(function() {
                    idsArr.push($(this).attr('data-id'));

                    console.log(idsArr);
                });

                if (idsArr.length <= 0) {
                    alert("Vui lòng chọn ít nhất một bản ghi để xóa.");
                } else {
                    if (confirm("Bạn có chắc chắn không, bạn muốn xóa các bản ghi đã chọn ?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "<?php echo e(route('admin.product.multiple_product_delete')); ?>",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + strIds,
                            success: function(data) {
                                // console.log(data);
                                if (data['status'] == true) {
                                    $(".checkbox:checked").each(function() {
                                        // $(this).parents("tr").remove();
                                        $('input[type=checkbox]').prop('checked',
                                            false);
                                        location.reload();

                                        // $(this).parents("tr").reset();
                                    });
                                    alert(data['message']);
                                } else {
                                    alert('Rất tiếc, đã xảy ra lỗi!!');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/admin/pages/product/list.blade.php ENDPATH**/ ?>