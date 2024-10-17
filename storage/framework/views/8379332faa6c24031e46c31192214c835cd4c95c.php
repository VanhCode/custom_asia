
<?php $__env->startSection('title', 'Danh sách thông tin liên hệ'); ?>
<?php $__env->startSection('css'); ?>
    <style>
        ul {
            padding-left: 0px;
        }

        table {
            font-size: 13px;
        }

        .btn-change-status {
            font-weight: bold
        }

        .btn-change-status {
            font-weight: bold
        }

        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            font-size: 40px;
            color: #777;
            margin-bottom: 10px;
        }

        .stat-content h4 {
            margin: 0;
            font-size: 18px;
            color: #666;
        }

        .stat-content h2 {
            margin: 5px 0 0;
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        .stat-card.success .stat-icon {
            color: #28a745;
        }

        .stat-card.info .stat-icon {
            color: #17a2b8;
        }

        .stat-card.danger .stat-icon {
            color: #dc3545;
        }

        /* Add any additional styles for spacing */
        .container {
            margin-top: 40px;
        }

        table {
            margin-top: 20px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            text-transform: uppercase;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        h3 {
            margin-bottom: 20px;
        }

        .styled-div {
            background-color: #f0f0f0;
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 5px 10px;
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .styled-div:hover {
            background-color: #e0e0e0;
            /* Màu nền khi hover */
        }
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 600;
            font-size: 14px;
        }
        .styled-div {
            background-color: #f0f0f0;
            border: 1px solid #007bff;
            border-radius: 2px;
            font-size: 13px;
            padding: 5px 10px;
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333;
            box-shadow: unset;
        }
        table {
            font-size: 12px;
        }
        .mt-2, .my-2 {
            margin-top: 0px !important;
        }
        table select{
            background-color: transparent !important;
            border: 0px !important;
            font-size: 12px !important;
            color: black !important;
            height: unset !important;
            padding: 0px !important;
        }
        .btn {
            padding: 1px 8px;
            font-size: 12px;
            font-weight: 300 !important;
        }
        .modal-body {
            font-size: 14px;
        }
        .modal-header{
            padding: 5px 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php
    $start_date = isset(request()->start_date) && !empty(request()->start_date) ? request()->start_date : null;
    $end_date = isset(request()->end_date) && !empty(request()->end_date) ? request()->end_date : null;
?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <?php echo $__env->make('admin.partials.content-header', ['name' => 'Liên hệ', 'key' => 'Danh sách liên hệ'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
            
                <div>
                    <form action="<?php echo e(route('admin.contact.booking')); ?>" method="GET">
                        <!-- Input text -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nameInput">Từ khóa:</label>
                                    <input type="text" class="form-control" id="nameInput" name="keyword"
                                        placeholder="Nhập từ khóa..." value="<?php echo e(request()->keyword); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="categorySelect">Trạng thái:</label>
                                    <select class="form-control" id="categorySelect" name="status">
                                        <option value="">--Chọn trạng thái--</option>
                                        <option <?php if(request()->status == 1): ?> selected <?php endif; ?> value="1">New
                                        </option>
                                        <option <?php if(request()->status == 2): ?> selected <?php endif; ?> value="2">Sold
                                        </option>
                                        <option <?php if(request()->status == 3): ?> selected <?php endif; ?> value="3">InActive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="startDate">Từ ngày:</label>
                                    <input type="date" class="form-control" id="startDate" name="start_date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="endDate">Đến ngày:</label>
                                    <input type="date" class="form-control" id="endDate" name="end_date">
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-between">
                            <div class="styled-div">
                                All contact: (<?php echo e($totalBooking); ?>)
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mx-2">Lọc kết quả</button>
                                <a href="<?php echo e(route('admin.contact.booking')); ?>">
                                    <button type="button" class="btn btn-default">Reset</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="total-container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên yêu cầu</th>
                                <th>Trạng thái</th>
                                <th>Mã yêu cầu</th>
                                <th>Tên Sales</th>
                                <th>Thời gian nhận</th>
                                <th>Giá bán</th>
                                <th>Thời gian đi</th>
                                <th>Tên khách hàng</th>
                                <th>Quốc gia</th>
                                <th>Email</th>
                                <th>Nội dung </th>
                                <th>Số khách</th>
                                <th>Thực hiện</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($bookings) && $bookings->count() > 0): ?>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($booking->name); ?></td>
                                        <td><?php echo $booking->generateButtonStatus(); ?></td>
                                        <td class="booking-code-<?php echo e($booking->id); ?>"><?php echo e($booking->code); ?></td>
                                        <td>
                                            <select id="booking-code-<?php echo e($booking->id); ?>" class="form-control select-sale"
                                                data-id=<?php echo e($booking->id); ?>>
                                                <option value="">--Chưa có--</option>
                                                <?php if(isset($sales) && $sales->count() > 0): ?>
                                                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($booking->admin_id == $sale->id): ?> selected <?php endif; ?>
                                                            value="<?php echo e($sale->id); ?>"><?php echo e($sale->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            

                                        </td>
                                        <td><?php echo e($booking->created_at->format('d/m/Y')); ?></td>
                                        <td>$<?php echo e(number_format($booking->price)); ?></td>
                                        <td><?php echo e(Carbon::parse($booking->date_to)->format('d/m/Y')); ?></td>
                                        <td>
                                            <?php echo e($booking->customer_title . ' ' . $booking->customer_first_name . ' ' . $booking->customer_last_name); ?>

                                        </td>
                                        <td><?php echo e($booking->country); ?></td>
                                        <td><?php echo e($booking->email); ?></td>
                                        <td>
                                            <div class="model-info" data-toggle="modal" data-target="#modelInfo">
                                                <i class="fa fa-eye"
                                                    style="color: black;
                                                            cursor: pointer;
                                                            font-size: 17px;"></i>
                                                <div class="model-info-content" style="display:none"><?php echo $booking->plantrip; ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td> <?php echo e($booking->amount_customer); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.my-trip.create', ['booking_id' => $booking->id])); ?>"
                                                class="btn btn-primary btn-sm">
                                                Thêm
                                            </a>
                                            <button class="btn btn-danger btn-sm mt-2">Xóa</button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13">Total Price: $<?php echo e(number_format($totalPrice)); ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="13">Không có dữ liệu</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                    <div>
                        <?php echo e($bookings->withQueryString()->links()); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- The Modal chi tiết đơn hàng -->

    <!-- Modal Info -->
    <div id="modelInfo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Nội dung modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model Info -->

    <!-- Modal Info -->
    <div id="modelStatus" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Nội dung modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-warning btn-sm btn-change-status btn-change-status-ajax" data-status="1"
                                data-id="0" data-toggle="modal" data-target="#modelStatus">Mới</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-success btn-sm btn-change-status btn-change-status-ajax" data-status="2"
                                data-id="0" data-toggle="modal" data-target="#modelStatus">Đã
                                bán</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-danger btn-sm btn-change-status btn-change-status-ajax" data-status="3"
                                data-id="0" data-toggle="modal" data-target="#modelStatus">Đã hủy</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model Info -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            const modelInfoElements = document.querySelectorAll('.model-info');
            const modelInfo = document.getElementById('modelInfo');
            const modelStatus = document.getElementById('modelStatus');
            const btnsChangeStatusAjax = modelStatus.querySelectorAll('.btn-change-status-ajax');
            const btnsChangeStatus = document.querySelectorAll('.btn-change-status-model')
            const allSelectSale = document.querySelectorAll('.select-sale');

            modelInfoElements.forEach(element => {
                element.addEventListener('click', function() {
                    const element = this.querySelector('.model-info-content');
                    modelInfo.querySelector('.modal-body').innerHTML = element.innerHTML;
                })
            });

            btnsChangeStatus.forEach(element => {
                element.addEventListener('click', function() {
                    btnsChangeStatusAjax.forEach(btnAjax => {
                        btnAjax.dataset.id = this.dataset.id
                        if (btnAjax.dataset.status == this.dataset.status) {
                            btnAjax.setAttribute('disabled', true)
                        }
                        btnAjax.addEventListener('click', function() {
                            let statusText = ''
                            switch (this.dataset.status) {
                                case '1':
                                    statusText = 'New'
                                    break;
                                case '2':
                                    statusText = 'Sold'
                                    break;
                                case '3':
                                    statusText = 'InActive'
                                    break;
                                default:
                                    break;
                            }
                            Swal.fire({
                                title: `Bạn có chắc chắn muốn thay đổi trạng thái thành ${statusText}?`,
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: 'Đồng ý',
                                denyButtonText: `Huỷ`,
                            }).then(({
                                isConfirmed
                            }) => {
                                if (isConfirmed) {
                                    let url =
                                        '<?php echo e(route('admin.contact.booking.changeStatus', ['id' => ':id'])); ?>';
                                    url = url.replace(':id', this.dataset
                                        .id);
                                    $.ajax({
                                        type: 'PATCH',
                                        url,
                                        data: {
                                            status: this.dataset
                                                .status,
                                            '_token': '<?php echo e(csrf_token()); ?>'
                                        },
                                        dataType: 'json',
                                        success: function(
                                            response) {
                                            if (response.code ==
                                                200) {
                                                window.location
                                                    .reload();
                                            }
                                        }
                                    })
                                }
                            })
                        })
                    });
                })
            });

            allSelectSale.forEach(element => {
                element.addEventListener('change', function() {
                    let url = '<?php echo e(route('admin.contact.booking.changeSale', ['id' => ':id'])); ?>';
                    url = url.replace(':id', this.dataset
                        .id);
                    $.ajax({
                        type: 'PATCH',
                        url,
                        data: {
                            sale: this.value,
                            '_token': '<?php echo e(csrf_token()); ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.code == 200) {
                                Swal.fire({
                                    position: 'center',
                                    title: `Cập nhật thành công`,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    const elemenCode = document.querySelector(
                                        this.id)
                                    elemenCode.value = this.value

                                })
                            }
                        }
                    })
                })
            })

            const startDate = document.getElementById('startDate')
            const endDate = document.getElementById('endDate')

            const start_date = '<?php echo e($start_date); ?>'
            const end_date = '<?php echo e($end_date); ?>'

            if (start_date) {
                startDate.value = start_date
            }
            if (end_date) {
                endDate.value = end_date
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\demo22\resources\views/admin/pages/contact/booking.blade.php ENDPATH**/ ?>