<?php $__env->startSection('title', 'My Trips'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('admin_asset/css/utilities.css')); ?>">
    <style>
        main {
            background-color: #eceff4;
        }

        .title__form {
            padding: 23px 0px;
            color: #464a4d;
            font-size: 25px;
            font-weight: 600;
        }

        .form .form-group {
            margin-bottom: 10px;
        }

        .form .form-group input {
            height: 37px;
        }

        .form .form-group input,
        .form .form-group textarea {
            border: 2px solid #c9cace;
            padding: 0px 10px;
            border-radius: 5px;
            background-color: transparent;
            font-size: 13px;
        }

        .check-btn {
            margin-bottom: 15px;
        }

        .check-btn button {
            background-color: #2a3f54;
            padding: 0px 10px;
            border-radius: 5px;
            height: 38px;
            width: 200px;
            color: white;
            font-size: 14px;
        }

        .check-btn button.check-btn--bg {
            background-color: #a4a4a4;
        }

        .check-img {
            background-color: white;
            padding: 12px 12px 0px 12px;
        }

        td,
        th {
            border: 2px solid #ebf0f4;;
        }

        table {
            width: 100%;
        }

        table td,
        table th {
            color: #464a4d;
            padding: 7px 10px;
            font-size: 14px;
            font-weight: 400;
        }

        .table-price {
            background-color: #dae4ee;
            border-top: 12px solid #ffffff;
        }

        .table-price-body {
            padding: 16px 12px;
        }

        table tr td select {
            width: 100%;
            background-color: unset;
            border: 0px;
            color: #464a4d;
        }

        tfoot th {
            background-color: #2a3f54;
            color: white;
            border: 0px solid #f5f8fd;
        }

        tr td:nth-child(2) {
            padding: 7px 15px;
        }

        tfoot th:nth-child(1) {
            padding-left: 68px;
        }

        thead tr th {
            background-color: #ebf0f4;
        }

        table.table-2 tfoot th {
            padding-left: 10px;
        }

        table.table-2 {
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 10px;
        }

        table.table-2 td,
        table.table-2 th {
            border: 1px solid #000;
        }

        table.table-2 tfoot th {
            background-color: #a4a4a4;
            color: black;
            text-transform: uppercase;
            font-weight: 500;
        }

        table.table-3 {
            border: 1px solid #2a3f54;
            border-collapse: collapse;
        }

        table.table-3 tfoot th {
            border: 1px solid #f5f8fd;
        }

        table.table-3 tfoot th:nth-child(1) {
            padding-left: 10px;
        }

        table.table-3 tfoot th {
            background-color: #2a3f54;
            color: #f1ff6f;
            text-transform: uppercase;
            font-size: 18px;
        }

        ul.list-tour-ad-text {
            margin-bottom: 20px;
        }

        ul.list-tour-ad-text li:nth-child(1) {
            border-top: 1px solid #bed5e7;
        }

        ul.list-tour-ad-text li {
            background-color: #dae4ee;
            border-left: 1px solid #bed5e7;
            border-right: 1px solid #bed5e7;
            border-bottom: 1px solid #bed5e7;
            padding: 10px 20px;
        }

        ul.list-tour-ad-text li {
            font-weight: 300;
        }

        ul.list-tour-ad-text li span {
            text-transform: uppercase;
            font-weight: 699;
            color: #414342;
        }

        .list-tour-ad-body ul.list-tour-ad-text li span:first-child {
            color: #ef4d26;
        }

        .list-tour-ad-left .check-btn button {
            width: 90%;
        }

        .list-tour-ad-body {
            background-color: white;
            padding: 18px;
        }

        .list-tour-ad-desc .desc {
            border: 1px solid #bed5e7;
            padding: 10px;
            margin-bottom: 10px;
            border-top: 0px;
            border-radius: 0px 0px 10px 10px;
        }

        .list-tour-ad-desc .desc p {
            font-size: 15px;
            font-weight: 300;
        }

        .table-service {
            background-color: #dae4ed;
            padding: 8px 8px;
            border: 1px solid #bed5e7;
            margin-top: 10px;
        }

        .list-tour-ad-right .check-btn button {
            background-color: #fff0;
            padding: 0px 10px;
            border-radius: 5px;
            height: 38px;
            width: 100%;
            color: #585b60;
            font-size: 14px;
            border: 1px solid gray;
        }

        main {
            padding: 0px 15px;
        }

        @media (max-width: 992px) {
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <?php echo $__env->make('admin.partials.content-header', ['name' => 'My Trips', 'key' => 'My Trips'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main>
            <form action="<?php echo e(route('admin.my-trip.update', $myTrip->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <section class="form">
                    <div style="--w-lg: 9; --w-xs: 12; margin: 0 auto">
                        <h2 class="title__form tt-up ta-center">
                            Itinerary Builder
                        </h2>
                        <div class="row">

                            <div class="clm" style="--w-lg: 3; --w-md: 6; --w-xs: 12;">
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_name" placeholder="Tên Tour"
                                           value="<?php echo e(isset($myTrip) ? $myTrip->tour_name : ''); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_code" placeholder="Tour Code"
                                           value="<?php echo e(isset($myTrip) ? $myTrip->tour_code : ''); ?>" readonly>
                                </div>
                                <div class="form-group">

                                    <input class="w-100" min="0" type="number" name="day_number" id="number_day"
                                           placeholder="Số Ngày"
                                           value="<?php echo e(isset($myTrip) && !is_null($myTrip->day_number) ? $myTrip->day_number : 0); ?>">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $dateStart = date('Y-m-d', \Carbon::parse($myTrip->date_start)->timestamp); // Chuyển timestamp sang định dạng Y-m-d
                                    ?>
                                    <input class="w-100" type="date" name="date_start" id="date_start" min
                                           placeholder="Ngày Đi Tour" value="<?php echo e($dateStart); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_class" id=""
                                           placeholder="Hạng Tour"
                                           value="<?php echo e(isset($myTrip) ? $myTrip->tour_class : ''); ?>">
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 7; --w-md: 6; --w-xs: 12;">
                                <div class="row js-center">
                                    <div class="clm" style="--w-lg: 8;">
                                        <div class="row">
                                            <div class="clm" style="--w-lg: 6;">
                                                <div class="form-group d-flex">
                                                    <input class="flex-1" type="text" name="title_name" id=""
                                                           placeholder="Xưng danh" readonly
                                                           value="<?php echo e(isset($myTrip) ? $myTrip->title_name : ''); ?>">

                                                </div>
                                            </div>
                                            <div class="clm" style="--w-lg: 6;">
                                                <div class="form-group d-flex">
                                                    <input class="flex-1" type="text" name="first_name" id=""
                                                           placeholder="First Name" readonly
                                                           value="<?php echo e(isset($myTrip) ? $myTrip->first_name : ''); ?>">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input class="w-100" type="text" name="country" id="" readonly
                                                   placeholder="Quốc Tịch"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->country : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="phone" id="" readonly
                                                   placeholder="Điện thoại"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->phone : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="email" id="" readonly
                                                   placeholder="Email"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->email : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="tour_type" id=""
                                                   placeholder="Loại Hình Tour"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->tour_type : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="clm" style="--w-lg: 3;">
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="last_name" id=""
                                                   placeholder="Last Name" readonly
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->last_name : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="adult_number" id="number_adult"
                                                   placeholder="Số Người Lớn" readonly
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->adult_number : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="number" name="kid_number" id=""
                                                   placeholder="Số Trẻ Con (<12)"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->kid_number : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="delegation_list" id=""
                                                   placeholder="Danh sách đoàn"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->delegation_list : ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="source" id=""
                                                   placeholder="Nguồn"
                                                   value="<?php echo e(isset($myTrip) ? $myTrip->source : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 2; --w-xs: 12;">
                                <div class="form-group">
                                    <input class="w-100" type="text" name="market" id=""
                                           placeholder="Thị Trường" value="<?php echo e(isset($myTrip) ? $myTrip->market : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="department" id=""
                                           placeholder="Phòng Ban"
                                           value="<?php echo e(isset($myTrip) ? $myTrip->department : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="group" id=""
                                           placeholder="Đội Nhóm" value="<?php echo e(isset($myTrip) ? $myTrip->group : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="language" id=""
                                           placeholder="Ngôn Ngữ Thị Trường"
                                           value="<?php echo e(isset($myTrip) ? $myTrip->language : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="execution_phase" id=""
                                           placeholder="Giai Đoạn Thực Hiện "
                                           value="<?php echo e(isset($myTrip) ? $myTrip->execution_phase : ''); ?>">
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 12; --w-xs: 12;">
                                <div class="form-group">
                                    <textarea class="w-100" name="note" id="" cols="30"
                                              rows="6"><?php echo e(isset($myTrip) ? $myTrip->note : ''); ?></textarea>
                                </div>
                            </div>
                            <div class="clm d-flex ai-center js-center" style="--w-lg: 12;  --w-xs: 12;">
                                <button type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="check">
                    <div class="row ai-end">
                        <div class="clm" style="--w-xl: 2; --w-md: 3; --w-xs: 12;">
                            <div class="check-btn ta-center">
                                <div class="model-info" data-toggle="modal" data-target="#modelInfo">
                                    <button type="button">Xem yêu cầu gốc</button>
                                </div>
                            </div>
                            <div class="check-btn ta-center">
                                <a href="<?php echo e(route('admin.my-trip.copy', $myTrip->id)); ?>" target="_blank">Nhân bản Tour
                                    Này</a>
                            </div>
                        </div>
                        <div class="clm" style="--w-xl: 8;  --w-md: 6; --w-xs: 12;">
                            <div class="check-img" id="thumbnail-wrapper">
                                <img class="d-block img-thumbnail"
                                     src="<?php echo e(!empty($myTrip->tour->image_path) ? $myTrip->tour->image_path : 'https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png'); ?>"
                                     alt="">
                                <div style="display: none">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a data-input="img-thumbnail-input" data-preview="img-thumbnail"
                                               class="btn btn-primary" id="img-thumbnail">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="img-thumbnail-input" class="form-control" type="text"
                                               name="avatar_path">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clm" style="--w-xl: 2;  --w-md: 3; --w-xs: 12;">
                            <div class="check-btn ta-center">
                                <button class="check-btn--bg">Export Word</button>
                            </div>
                            <div class="check-btn ta-center">
                                <button class="check-btn--bg">Export PDF</button>
                            </div>
                            <div class="check-btn ta-center">
                                <button class="check-btn--bg">Send Link</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="table-price">
                    <div class="row js-center">
                        <div class="clm" style="--w-xl: 8; --w-lg: 9; --w-xs: 12">
                            <div class="table-price-body table-service-all-body">
                                <table class="w-100">

                                    <thead>
                                    <tr>
                                        <th style="width: 45px;cursor: pointer" class="btn-add">+</th>
                                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                        <th class="ta-center tt-up">Gói giá dịch vụ cho cả tour</th>
                                        <th class="ta-center tt-up">Tên gói</th>
                                        <th class="ta-center tt-up">Tổng giá</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php if(!empty($myTrip->tour->tourServices)): ?>
                                        <?php
                                            $tongGia = 0;
                                        ?>
                                        <?php $__currentLoopData = $myTrip->tour->tourServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($tourService->serviceFullOptions) && isset($tourService->serviceFullOptions->price)): ?>
                                                <?php
                                                    $tongGia += $tourService->serviceFullOptions->price;
                                                ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td class="ta-center remove-btn" style="cursor: pointer"
                                                    data-remove="service-all-price-<?php echo e($tourService->id); ?>">-
                                                </td>
                                                <td>
                                                    <select class="my-select select2 select2-<?php echo e($tourService->id); ?>"
                                                            style="width: 100%;" name="full_tour[]">
                                                        <option value="">---</option>
                                                        <?php $__currentLoopData = $serviceFullTour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                <?php echo e($tourService->parentService->id == $tour->id ? 'selected' : ''); ?>

                                                                value="<?php echo e($tour->id); ?>"><?php echo e($tour->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td class="ta-center service-all-2">
                                                    <select
                                                        class="my-select select2 select2-child-<?php echo e($tourService->id); ?>"
                                                        style="width: 100%;" name="full_tour_child[]">
                                                        <option value="">---</option>
                                                        <?php $__currentLoopData = $serviceFullTourChilds->where('parent_id', $tourService->parentService->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceTou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                <?php echo e($tourService->service_id == $serviceTou->id ? 'selected' : ''); ?>

                                                                value="<?php echo e($serviceTou->id); ?>"><?php echo e($serviceTou->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                
                                                <td class="ta-center">
                                                    <select
                                                        class="my-select select2 select2-child-2-<?php echo e($tourService->id); ?>"
                                                        style="width: 100%;" name="full_tour_option[]">
                                                        <option value="">---</option>
                                                        <?php if(isset($tourService->serviceFullOptions) && isset($tourService->serviceFullOptions->service_season_id)): ?>
                                                            <?php $__currentLoopData = $serviceFullTourOptions->where('service_season_id', $tourService->serviceFullOptions->service_season_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceTou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    <?php echo e($tourService->serviceFullOptions->id == $serviceTou->id ? 'selected' : ''); ?>

                                                                    value="<?php echo e($serviceTou->id); ?>"><?php echo e($serviceTou->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td class="ta-center service-all-price-total service-all-price-<?php echo e($tourService->id); ?>"
                                                    data-price="0">
                                                    <?php echo e(isset($tourService->serviceFullOptions) && isset($tourService->serviceFullOptions->price) ? number_format($tourService->serviceFullOptions->price, 0, '', ',') : '0'); ?>

                                                    VND
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>

                                    <tfoot>
                                    <tr style="height: 10px;"></tr>
                                    <tr>
                                        <th colspan="3" class="ta-left">Tổng giá</th>
                                        <th></th>
                                        <th class="ta-center service-full-total-price"><?php echo e(number_format($tongGia, 0, '', ',')); ?>

                                            VND
                                        </th>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="list-tour-ad">
                    <div class="row">
                        <div class="clm" style="--w-xl: 2; --w-md: 3; --w-xs: 12;">
                            <div class="list-tour-ad-left">
                                <ul class="list-tour-ad-text" id="list-tour-day">
                                    <?php if(!empty($myTrip->tour->tourDays)): ?>
                                        <?php $__currentLoopData = $myTrip->tour->tourDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="day-box" data-target="day-box-<?php echo e($key + 1); ?>-<?php echo e($day->id); ?>">
                                                <span>Day <?php echo e(!empty($day->day_number) ? $day->day_number : $key + 1); ?></span>
                                                [<?php echo e(date('Y-m-d', strtotime($day->time))); ?>]
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="check-btn ta-center btn-add-day">
                                    <button class="">Thêm ngày</button>
                                </div>
                                <div class="check-btn ta-center">
                                    <button class="">Thêm gói tour</button>
                                </div>
                                <div class="check-btn ta-center">
                                    <button class="">Coppy Tour từ code khác</button>
                                </div>
                            </div>
                        </div>
                        <div class="clm" style="--w-xl: 8.5; --w-md: 7; --w-xs: 12;">
                            <div class="list-tour-ad-body">
                                <ul class="list-tour-ad-text">
                                    <div id="list-tour-day-content">
                                        <?php if(!empty($myTrip->tour->tourDays)): ?>
                                            <?php $__currentLoopData = $myTrip->tour->tourDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="wrap-list-option-ad" data-target="day-box-1-6137">
                                                    <span>Day <?php echo e(!empty($day->day_number) ? $day->day_number : $key + 1); ?></span>
                                                    <input type="hidden" name="day_order[]"
                                                           value="<?php echo e(!empty($day->day_number) ? $day->day_number : $key + 1); ?>">
                                                    <input type="hidden" name="day_time[]" value="<?php echo e($day->time); ?>">
                                                    [<?php echo e(date('Y-m-d', strtotime($day->time))); ?>]
                                                    <input type="text" class="w-100"
                                                           value="<?php echo e(!empty($day->name) ? $day->name : ''); ?>"
                                                           name="day_title[]">
                                                </li>
                                                <div class="list-tour-ad-desc " id="day-box-1-6137">
                                                    <div class="desc">
                                                        <textarea class="w-100"
                                                                  name="day_description[]"><?php echo e(!empty($day->description) ? $day->description : ''); ?></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                            <div class="check-img" id="content1-1-wrapper">
                                                                <img class="d-block img-content1-1"
                                                                     src="<?php echo e(!empty($day->image_path1) ? $day->image_path1 : 'https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png'); ?>"
                                                                     alt="">
                                                                <div style="display: none">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <a data-input="img-content1-1-input"
                                                                               data-preview="img-content1-1"
                                                                               class="btn btn-primary"
                                                                               id="img-content1-1">
                                                                                <i class="fa fa-picture-o"></i> Choose
                                                                            </a>
                                                                        </span>
                                                                        <input id="img-content1-1-input"
                                                                               class="form-control" type="text"
                                                                               value="<?php echo e(!empty($day->image_path1) ? $day->image_path1 : ''); ?>"
                                                                               name="day_image_path1[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                            <div class="check-img" id="content1-2-wrapper">
                                                                <img class="d-block img-content1-2"
                                                                     src="<?php echo e(!empty($day->image_path2) ? $day->image_path2 : 'https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png'); ?>"
                                                                     alt="">
                                                                <div style="display: none">
                                                                    <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <a data-input="img-content1-2-input"
                                                                       data-preview="img-content1-2"
                                                                       class="btn btn-primary" id="img-content1-2">
                                                                        <i class="fa fa-picture-o"></i> Choose
                                                                    </a>
                                                                </span>
                                                                        <input id="img-content1-2-input"
                                                                               value="<?php echo e(!empty($day->image_path2) ? $day->image_path2 : ''); ?>"
                                                                               class="form-control" type="text"
                                                                               name="day_image_path2[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table class="w-100">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 45px;" class="btn-add-option"
                                                                data-day="1">+
                                                            </th>
                                                            <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                                            <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                                            <th class="ta-center tt-up">Tên gói</th>
                                                            <th class="ta-center tt-up">Tổng giá</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if($day->tourDayOptions()->count() > 0): ?>
                                                            <?php
                                                                $randoms = [];
                                                                for ($i = 0; $i < $day->tourDayOptions()->count(); $i++) {
                                                                    $random = rand();
                                                                    while (in_array($random, $randoms)) {
                                                                        $random = rand();
                                                                    }
                                                                    $randoms[] = $random;
                                                                }

                                                                $servicesOptions = \App\Models\Service::where('parent_id', 0)->get();
                                                            ?>
                                                            <?php $__currentLoopData = $day->tourDayOptions()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $tourDayOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td class="ta-center remove-btn "
                                                                        data-remove="service-all-price-<?php echo e($randoms[$i]); ?>"
                                                                        style="cursor: pointer">-
                                                                    </td>
                                                                    <td>
                                                                        <select
                                                                            class="my-select select2 select2-<?php echo e($randoms[$i]); ?>"
                                                                            style="width: 100%;"
                                                                            name="day_service[<?php echo e($day->day_number); ?>][]">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $servicesOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicesOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    <?php if($tourDayOption->parent_service_id == $servicesOption->id): ?> selected
                                                                                    <?php endif; ?>
                                                                                    value="<?php echo e($servicesOption->id); ?>"><?php echo e($servicesOption->name); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <td class="ta-center service-all-2">
                                                                        <select
                                                                            class="my-select select2 select2-child-<?php echo e($randoms[$i]); ?>"
                                                                            style="width: 100%;"
                                                                            name="day_service_child[<?php echo e($day->day_number); ?>][]">
                                                                            <option value=""></option>
                                                                            <?php
                                                                                $servicesOptionsChild = \App\Models\Service::where(
                                                                                    'parent_id',
                                                                                    $tourDayOption->parent_service_id
                                                                                )->get();
                                                                            ?>
                                                                            <?php if($servicesOptionsChild->count() > 0): ?>
                                                                                <?php $__currentLoopData = $servicesOptionsChild; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicesOptionChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option
                                                                                        <?php if($servicesOptionChild->id == $tourDayOption->service_id): ?> selected
                                                                                        <?php endif; ?>
                                                                                        value="<?php echo e($servicesOptionChild->id); ?>">
                                                                                        <?php echo e($servicesOptionChild->name); ?>

                                                                                    </option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </td>
                                                                    <?php
                                                                        $option = \App\Models\ServiceOption::find($tourDayOption->option_id);
                                                                        $listOption = \App\Models\ServiceOption::where(
                                                                            'service_season_id',
                                                                            $option->service_season_id
                                                                        )->get();
                                                                    ?>
                                                                    <td class="ta-center">
                                                                        <select
                                                                            class="my-select select2 select2-child-2-<?php echo e($randoms[$i]); ?>"
                                                                            style="width: 100%;"
                                                                            name="day_service_option[<?php echo e($day->day_number); ?>][]">
                                                                            <option value=""></option>
                                                                            <?php if($listOption->count() > 0): ?>
                                                                                <?php $__currentLoopData = $listOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option
                                                                                        <?php if($item->id == $tourDayOption->option_id): ?> selected
                                                                                        <?php endif; ?>
                                                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?>

                                                                                    </option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </td>
                                                                    <td class="ta-center service-price service-all-price-<?php echo e($randoms[$i]); ?>"
                                                                        data-price="<?php echo e($option->price); ?>">
                                                                        <?php echo e(number_format($option->price, 0, '', ',')); ?>

                                                                        VND
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <table class="w-100 table-2">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Tổng chi phí chung
                                            </td>
                                            <td class="ta-center" style="width: 450px;"></td>
                                            <td class="ta-center total-price-box-1 service-full-total-price"
                                                style="width: 130px;" data-input-hidden="overhead_costs">
                                                <?php echo e(number_format($tongGia, 0, '', ',')); ?> VND
                                            </td>
                                            <input type="hidden" value="<?php echo e($tongGia); ?>" name="overhead_costs"
                                                   id="overhead_costs">
                                        </tr>
                                        <tr>
                                            <td>
                                                Tổng chi phí dịch vụ lẻ từng ngày
                                            </td>
                                            <td class="ta-center" style="width: 450px;"></td>
                                            <td class="ta-center total-price-box-1 service-individual-total-price"
                                                data-input-hidden="individual_costs"><?php echo e(number_format($myTrip->individual_costs, 0, '', ',')); ?>

                                                VND
                                            </td>
                                            <input type="hidden" value="<?php echo e($myTrip->individual_costs); ?>"
                                                   name="individual_costs" id="individual_costs">
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="ta-left">Chi Phí tour
                                            </th>
                                            <th>
                                                <input type="number" value="<?php echo e($myTrip->tour_costs_percent); ?>" min="0"
                                                       class="result-price-box-1-percent" name="tour_costs_percent">%
                                            </th>
                                            <th class="ta-center total-price-box result-price-box-1"
                                                data-hidden="input-hidden-box-1"
                                                data-limit="<?php echo e($myTrip->tour_costs * (1 - ($myTrip->tour_costs_percent / 100))); ?>"
                                                data-price="<?php echo e($myTrip->tour_costs); ?>"
                                                data-input-hidden="tour_costs"><?php echo e(number_format($myTrip->tour_costs, 0, '', ',')); ?>

                                                VND
                                            </th>
                                            <input type="hidden" class="price-total-item input-hidden-box-1"
                                                   data-price="<?php echo e($myTrip->tour_costs); ?>">
                                            <input type="hidden" name="tour_costs" value="<?php echo e($myTrip->tour_costs); ?>"
                                                   id="tour_costs">
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <?php if(isset($myTrip->priceTypeServiceTrips) && $myTrip->priceTypeServiceTrips->count() > 0): ?>
                                        <table class="w-100  table-2">
                                            <tbody>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <?php
                                                $serviceTypes = \App\Models\ServiceType::with('priceTypeServiceTrips')->get();
                                            ?>
                                            <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        Chi phí <?php echo e($type->name); ?>

                                                        <input type="hidden" name="service_type_id[]"
                                                               value="<?php echo e($type->id); ?>">
                                                    </td>
                                                    <td class="ta-center" style="width: 450px;">
                                                        <input type="number" class="price-tour-box-2-percent"
                                                               value="<?php echo e($type->priceTypeServiceTrips[0]->pivot->percent); ?>" min="0" data-limit="0"
                                                               name="service_type_percent[]"
                                                               data-target="price-tour-box-2-percent-<?php echo e($type->id); ?>"
                                                               data-input="<?php echo e($type->id); ?>">%
                                                    </td>
                                                    <td class="ta-center price-tour-box-2 price-tour-box-2-percent-<?php echo e($type->id); ?>"
                                                        data-target="price-tour-box-2-<?php echo e($type->id); ?>"
                                                        style="width: 130px;" data-price="0"
                                                        data-input-hidden="service_type_price-<?php echo e($type->id); ?>">
                                                        <?php if($type->priceTypeServiceTrips->isNotEmpty()): ?>
                                                            <?php echo e(number_format($type->priceTypeServiceTrips[0]->pivot->price, 0, '', ',')); ?> VND
                                                        <?php else: ?>
                                                            0 VND
                                                        <?php endif; ?>
                                                    </td>
                                                    <input type="hidden" name="service_type_price[]"
                                                           id="service_type_price-<?php echo e($type->id); ?>"
                                                           value="<?php echo e(!empty($type->priceTypeServiceTrips[0]->pivot->price) ? $type->priceTypeServiceTrips[0]->pivot->price : 0); ?>">
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th class="ta-left ">Giá tour
                                                </th>
                                                <th class="ta-center total-price-tour-box-2-one" data-price="0"
                                                    data-input-hidden="total_price_tour_one"><?php echo e(number_format($myTrip->tour_price_per_person, 0, '', ',')); ?>

                                                    VND
                                                    /
                                                    NGƯỜI
                                                </th>
                                                <input type="hidden" value="<?php echo e($myTrip->tour_price_per_person); ?>"
                                                       name="tour_price_per_person"
                                                       id="total_price_tour_one">
                                                <th class="ta-center price-total-item total-price-box total-price-tour-box-2"
                                                    data-target="total-price-tour-box-2-one" data-price="0"
                                                    data-input-hidden="total_price_tour">
                                                    <?php echo e(number_format($myTrip->tour_price, 0, '', ',')); ?> VND
                                                </th>
                                                <input type="hidden" value="<?php echo e($myTrip->tour_price); ?>" name="tour_price"
                                                       id="total_price_tour">
                                            </tr>
                                            </tfoot>
                                        </table>
                                    <?php endif; ?>
                                    <table class="w-100 table-2 service-other-table">
                                        <tbody>
                                        <?php if(!empty($myTrip->surchargeTrips)): ?>
                                            <?php $__currentLoopData = $myTrip->surchargeTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $surchargeTrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="ta-center remove-btn" style="cursor: pointer"
                                                        data-remove="service-all-price-<?php echo e($surchargeTrip->id); ?>">-
                                                    </td>
                                                    <td>
                                                        <select
                                                            class="my-select select2 select2-<?php echo e($surchargeTrip->id); ?>"
                                                            style="width: 100%;" name="service_other_id[]">
                                                            <option value="">---</option>
                                                            <?php $__currentLoopData = $surcharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    <?php echo e($surchargeTrip->surcharge_id == $item->id ? 'selected' : ''); ?>

                                                                    value="<?php echo e($item->id); ?>"
                                                                    data-price="<?php echo e($item->price); ?>"><?php echo e($item->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td class="ta-center service-other-price-one service-other-price-one-${random}"
                                                        data-price="0"
                                                        data-input-hidden="price_other_one-<?php echo e($surchargeTrip->id); ?>">
                                                        <?php echo e(number_format($surchargeTrip->price_per_one, 0, '', ',')); ?>

                                                        VND/ Người
                                                    </td>
                                                    <input type="hidden" value="<?php echo e($surchargeTrip->price_per_one); ?>"
                                                           name="price_other_one[]"
                                                           id="price_other_one-<?php echo e($surchargeTrip->id); ?>">
                                                    <td class="ta-center service-other-price-total service-other-price-<?php echo e($surchargeTrip->id); ?> "
                                                        data-target="service-other-price-one-<?php echo e($surchargeTrip->id); ?>"
                                                        data-price="0"
                                                        data-input-hidden="price_other-<?php echo e($surchargeTrip->id); ?>">
                                                        <?php echo e(number_format($surchargeTrip->price, 0, '', ',')); ?> VND
                                                    </td>
                                                    <input type="hidden" name="price_other[]"
                                                           value="<?php echo e($surchargeTrip->price); ?>"
                                                           id="price_other-<?php echo e($surchargeTrip->id); ?>">
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="add-btn-service-other">+</th>
                                            <th class="ta-left">Phụ thu
                                            </th>
                                            <th class="ta-center total-price-service-other-one"
                                                data-input-hidden="total_price_other_one">
                                                <?php echo e(number_format($myTrip->surcharge_per_person, 0, '', ',')); ?> VND /
                                                người
                                            </th>
                                            <input type="hidden" value="<?php echo e($myTrip->surcharge_per_person); ?>"
                                                   name="surcharge_per_person"
                                                   id="total_price_other_one">
                                            <th class="ta-center price-total-item total-price-service-other"
                                                data-input-hidden="total_price_other">
                                                <?php echo e(number_format($myTrip->surcharge, 0, '', ',')); ?> VND
                                            </th>
                                            <input type="hidden" value="<?php echo e($myTrip->surcharge); ?>" name="surcharge"
                                                   id="total_price_other">
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <table class="w-100 table-3">
                                        <tfoot>
                                        <tr>
                                            <th class="ta-left">Tổng chi phí
                                            </th>
                                            <th style="width: 450px;" class="ta-center total-price-final-one"
                                                data-input-hidden="total_price_final_one">
                                                <?php echo e(number_format($myTrip->final_cost_per_person, 0, '', ',')); ?> VND /
                                                người
                                            </th>
                                            <input type="hidden" value="<?php echo e($myTrip->final_cost_per_person); ?>"
                                                   name="final_cost_per_person"
                                                   id="total_price_final_one">
                                            <th class="ta-center total-price-final" style="width: 130px;"
                                                data-input-hidden="total_price_final">
                                                <?php echo e(number_format($myTrip->final_cost, 0, '', ',')); ?> VND
                                            </th>
                                            <input type="hidden" value="<?php echo e($myTrip->final_cost); ?>" name="final_cost"
                                                   id="total_price_final">
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="table-service">
                                        <div class="row">
                                            <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                <table class="w-100">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 45px;" class="btn-add-included">+</th>
                                                        <th class="tt-up">Dịch vụ bao gồm</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody class="service-included-body">
                                                    <?php $__currentLoopData = $myTrip->includeServiceTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $includeServiceTrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($includeServiceTrip->type == 1): ?>
                                                            <tr>
                                                                <td class="ta-center remove-btn">-</td>
                                                                <td>
                                                                    <select class="form-select select2"
                                                                            name="included[]" id="">
                                                                        <option value="">-- Chọn dịch vụ --</option>
                                                                        <?php if(!empty($serviceIncluded)): ?>
                                                                            <?php $__currentLoopData = $serviceIncluded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    <?php if($includeServiceTrip->service_id == $value->id): ?> selected
                                                                                    <?php endif; ?>
                                                                                    value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                <table class="w-100">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 45px;" class="btn-add-excluding">+</th>
                                                        <th class="tt-up">Dịch vụ không bao gồm</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody class="service-excluding-body">
                                                    <?php $__currentLoopData = $myTrip->includeServiceTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $includeServiceTrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($includeServiceTrip->type == 2): ?>
                                                            <tr>
                                                                <td class="ta-center remove-btn">-</td>
                                                                <td>
                                                                    <select class="form-select select2"
                                                                            name="excluding[]" id="">
                                                                        <option value="">
                                                                            -- Chọn dịch vụ không bao gồm --
                                                                        </option>
                                                                        <?php if(!empty($serviceIncluded)): ?>
                                                                            <?php $__currentLoopData = $serviceIncluded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option
                                                                                    <?php if($includeServiceTrip->service_id == $value->id): ?> selected
                                                                                    <?php endif; ?>
                                                                                    value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="clm" style="--w-xl:1.5;  --w-md: 12; --w-xs: 12;">
                            <div class="list-tour-ad-right">
                                <div class="check-btn ta-center">
                                    <button class="tt-up btn-view-all">View all days +</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </main>
        <!-- Modal Info -->
        <div id="modelInfo" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Nội dung modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong><?php echo e($myTrip->name); ?></strong><br>
                        <?php echo $myTrip->plantrip; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Model Info -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $('.select2').select2({
            placeholder: 'Select an service',
            allowClear: true,
        })

        const serviceFullTour = <?php echo json_encode($serviceFullTour->toArray(), 15, 512) ?>;
        const serviceTour = <?php echo json_encode($serviceTour->toArray(), 15, 512) ?>;
        const serviceIncluded = <?php echo json_encode($serviceIncluded, 15, 512) ?>;

        const routeGetChild = '<?php echo e(route('admin.service-full.getChild', ['id' => ':id'])); ?>';
        const routeGetOptionByServiceId = '<?php echo e(route('admin.service-full-option.getOptionByServiceId', ['id' => ':id'])); ?>';

        const routeServiceGetChild = '<?php echo e(route('admin.service.getChild', ['id' => ':id'])); ?>';
        const routeServiceGetOptionByServiceId =
            '<?php echo e(route('admin.service-option.getOptionByServiceId', ['id' => ':id'])); ?>';

        const serviceOther = <?php echo json_encode($serviceOther, 15, 512) ?>;
    </script>
    <script src="<?php echo e(asset('custom/js/my-trip/helper.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/function.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/file-manager.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/service-all-tour.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/day-service.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/total-price-box2.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/service-other.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/service-include.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/my-trip/main.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/admin/pages/my-trip/copy.blade.php ENDPATH**/ ?>