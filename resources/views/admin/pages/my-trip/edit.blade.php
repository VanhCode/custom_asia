@extends('admin.layouts.main')
@section('title', 'My Trips')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/utilities.css') }}">
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
            border: 2px solid #ebf0f4;
            ;
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

        @media (max-width: 992px) {}
    </style>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', ['name' => 'My Trips', 'key' => 'My Trips'])

        <main>
            <form action="{{ route('admin.my-trip.store') }}" method="POST">
                @csrf
                <section class="form">
                    <div style="--w-lg: 9; --w-xs: 12; margin: 0 auto">
                        <h2 class="title__form tt-up ta-center">
                            Itinerary Builder
                        </h2>
                        <div class="row">

                            <div class="clm" style="--w-lg: 3; --w-md: 6; --w-xs: 12;">
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_name" placeholder="Tên Tour"
                                        value="{{ isset($myTrip) ? $myTrip->tour_name : '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_code" placeholder="Tour Code"
                                        value="{{ isset($myTrip) ? $myTrip->tour_code : '' }}" readonly>
                                </div>
                                <div class="form-group">

                                    <input class="w-100" min="0" type="number" name="day_number" id="number_day"
                                        placeholder="Số Ngày"
                                        value="{{ isset($myTrip) && !is_null($myTrip->day_number) ? $myTrip->day_number : 0 }}">
                                </div>
                                <div class="form-group">
                                    @php
                                        $dateStart = date('Y-m-d', \Carbon::parse($myTrip->date_start)->timestamp); // Chuyển timestamp sang định dạng Y-m-d
                                    @endphp
                                    <input class="w-100" type="date" name="date_start" id="date_start" min
                                        placeholder="Ngày Đi Tour" value="{{ $dateStart }}">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="tour_class" id=""
                                        placeholder="Hạng Tour" value="{{ isset($myTrip) ? $myTrip->tour_class : '' }}">
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
                                                        value="{{ isset($myTrip) ? $myTrip->title_name : '' }}">

                                                </div>
                                            </div>
                                            <div class="clm" style="--w-lg: 6;">
                                                <div class="form-group d-flex">
                                                    <input class="flex-1" type="text" name="first_name" id=""
                                                        placeholder="First Name" readonly
                                                        value="{{ isset($myTrip) ? $myTrip->first_name : '' }}">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input class="w-100" type="text" name="country" id="" readonly
                                                placeholder="Quốc Tịch"
                                                value="{{ isset($myTrip) ? $myTrip->country : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="phone" id="" readonly
                                                placeholder="Điện thoại"
                                                value="{{ isset($myTrip) ? $myTrip->phone : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="email" id="" readonly
                                                placeholder="Email" value="{{ isset($myTrip) ? $myTrip->email : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="tour_type" id=""
                                                placeholder="Loại Hình Tour"
                                                value="{{ isset($myTrip) ? $myTrip->tour_type : '' }}">
                                        </div>
                                    </div>
                                    <div class="clm" style="--w-lg: 3;">
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="last_name" id=""
                                                placeholder="Last Name" readonly
                                                value="{{ isset($myTrip) ? $myTrip->last_name : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="adult_number" id="number_adult"
                                                placeholder="Số Người Lớn" readonly
                                                value="{{ isset($myTrip) ? $myTrip->adult_number : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="number" name="kid_number" id=""
                                                placeholder="Số Trẻ Con (<12)"
                                                value="{{ isset($myTrip) ? $myTrip->kid_number : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="delegation_list" id=""
                                                placeholder="Danh sách đoàn"
                                                value="{{ isset($myTrip) ? $myTrip->delegation_list : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <input class="w-100" type="text" name="source" id=""
                                                placeholder="Nguồn" value="{{ isset($myTrip) ? $myTrip->source : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 2; --w-xs: 12;">
                                <div class="form-group">
                                    <input class="w-100" type="text" name="market" id=""
                                        placeholder="Thị Trường" value="{{ isset($myTrip) ? $myTrip->market : '' }}">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="department" id=""
                                        placeholder="Phòng Ban" value="{{ isset($myTrip) ? $myTrip->department : '' }}">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="group" id=""
                                        placeholder="Đội Nhóm" value="{{ isset($myTrip) ? $myTrip->group : '' }}">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="language" id=""
                                        placeholder="Ngôn Ngữ Thị Trường"
                                        value="{{ isset($myTrip) ? $myTrip->language : '' }}">
                                </div>
                                <div class="form-group">
                                    <input class="w-100" type="text" name="execution_phase" id=""
                                        placeholder="Giai Đoạn Thực Hiện "
                                        value="{{ isset($myTrip) ? $myTrip->execution_phase : '' }}">
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 12; --w-xs: 12;">
                                <div class="form-group">
                                    <textarea class="w-100" name="note" id="" cols="30" rows="6">
                                        {{ isset($myTrip) ? $myTrip->note : '' }}
                                    </textarea>
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
                                <button>Nhân bản Tour Này</button>
                            </div>
                        </div>
                        <div class="clm" style="--w-xl: 8;  --w-md: 6; --w-xs: 12;">
                            <div class="check-img" id="thumbnail-wrapper">
                                <img class="d-block img-thumbnail"
                                    src="{{ isset($myTrip) && !is_null($myTrip->image_path) ? $myTrip->image_path : 'https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png' }}"
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

                                    </tbody>

                                    <tfoot>
                                        <tr style="height: 10px;"></tr>
                                        <tr>
                                            <th colspan="3" class="ta-left">Tổng giá</th>
                                            <th></th>
                                            <th class="ta-center service-full-total-price">{{ isset($myTrip) ? $myTrip->total_price }} VND</th>
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
                                    {{-- <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                    </li> --}}
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
                                                    0 VND
                                                </td>
                                                <input type="hidden" name="overhead_costs" id="overhead_costs">
                                            </tr>
                                            <tr>
                                                <td>
                                                    Tổng chi phí dịch vụ lẻ từng ngày
                                                </td>
                                                <td class="ta-center" style="width: 450px;"></td>
                                                <td class="ta-center total-price-box-1 service-individual-total-price"
                                                    data-input-hidden="individual_costs">0
                                                    VND
                                                </td>
                                                <input type="hidden" name="individual_costs" id="individual_costs">
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="ta-left">Chi Phí tour
                                                </th>
                                                <th>
                                                    <input type="number" value="0" min="0"
                                                        class="result-price-box-1-percent" name="tour_costs_percent">%
                                                </th>
                                                <th class="ta-center total-price-box result-price-box-1"
                                                    data-hidden="input-hidden-box-1" data-limit="0" data-price="0"
                                                    data-input-hidden="tour_costs">0 VND
                                                </th>
                                                <input type="hidden" class="price-total-item input-hidden-box-1"
                                                    data-price="0">
                                                <input type="hidden" name="tour_costs" id="tour_costs">
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @if (isset($serviceTypes) && $serviceTypes->count() > 0)
                                        <table class="w-100  table-2">
                                            <tbody>
                                                @foreach ($serviceTypes as $type)
                                                    <tr>
                                                        <td>
                                                            Chi phí {{ $type->name }}
                                                            <input type="hidden" name="service_type_id[]"
                                                                value="{{ $type->id }}">
                                                        </td>
                                                        <td class="ta-center" style="width: 450px;">
                                                            <input type="number" class="price-tour-box-2-percent"
                                                                value="0" min="0" data-limit="0"
                                                                name="service_type_percent[]"
                                                                data-target="price-tour-box-2-percent-{{ $type->id }}"
                                                                data-input="{{ $type->id }}">%
                                                        </td>
                                                        <td class="ta-center price-tour-box-2 price-tour-box-2-percent-{{ $type->id }}"
                                                            data-target="price-tour-box-2-{{ $type->id }}"
                                                            style="width: 130px;" data-price="0"
                                                            data-input-hidden="service_type_price-{{ $type->id }}">0
                                                            VND</td>
                                                        <input type="hidden" name="service_type_price[]"
                                                            id="service_type_price-{{ $type->id }}">
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="ta-left ">Giá tour
                                                    </th>
                                                    <th class="ta-center total-price-tour-box-2-one" data-price="0"
                                                        data-input-hidden="total_price_tour_one">0 VND
                                                        /
                                                        NGƯỜI
                                                    </th>
                                                    <input type="hidden" name="tour_price_per_person"
                                                        id="total_price_tour_one">
                                                    <th class="ta-center price-total-item total-price-box total-price-tour-box-2"
                                                        data-target="total-price-tour-box-2-one" data-price="0"
                                                        data-input-hidden="total_price_tour">
                                                        0 VND
                                                    </th>
                                                    <input type="hidden" name="tour_price" id="total_price_tour">
                                                </tr>
                                            </tfoot>
                                        </table>
                                    @endif
                                    <table class="w-100 table-2 service-other-table">
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="add-btn-service-other">+</th>
                                                <th class="ta-left">Phụ thu
                                                </th>
                                                <th class="ta-center total-price-service-other-one"
                                                    data-input-hidden="total_price_other_one">
                                                    0 VND/ người
                                                </th>
                                                <input type="hidden" name="surcharge_per_person"
                                                    id="total_price_other_one">
                                                <th class="ta-center price-total-item total-price-service-other"
                                                    data-input-hidden="total_price_other">
                                                    0 VND
                                                </th>
                                                <input type="hidden" name="surcharge" id="total_price_other">
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
                                                    0 VND/ người
                                                </th>
                                                <input type="hidden" name="final_cost_per_person"
                                                    id="total_price_final_one">
                                                <th class="ta-center total-price-final" style="width: 130px;"
                                                    data-input-hidden="total_price_final">
                                                    0 VND
                                                </th>
                                                <input type="hidden" name="final_cost" id="total_price_final">
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
                                                        {{-- <tr>
                                                            <td class="ta-center">-</td>
                                                            <td>Xe riêng chỗ</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ta-center">-</td>
                                                            <td>Xe riêng chỗ</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ta-center">-</td>
                                                            <td>Xe riêng chỗ</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ta-center">-</td>
                                                            <td>Xe riêng chỗ</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ta-center">-</td>
                                                            <td>Xe riêng chỗ</td>
                                                        </tr> --}}
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
                        <strong>{{ $myTrip->name }}</strong><br>
                        {!! $myTrip->plantrip !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Model Info -->
    </div>
@endsection
@section('js')
    <script>
        const serviceFullTour = @json($serviceFullTour);
        const serviceTour = @json($serviceTour);
        const serviceIncluded = @json($serviceIncluded);

        const routeGetChild = '{{ route('admin.service-full.getChild', ['id' => ':id']) }}';
        const routeGetOptionByServiceId = '{{ route('admin.service-full-option.getOptionByServiceId', ['id' => ':id']) }}';

        const routeServiceGetChild = '{{ route('admin.service.getChild', ['id' => ':id']) }}';
        const routeServiceGetOptionByServiceId =
            '{{ route('admin.service-option.getOptionByServiceId', ['id' => ':id']) }}';

        const serviceOther = @json($serviceOther);
    </script>
    <script src="{{ asset('custom/js/my-trip/helper.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/function.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/file-manager.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/service-all-tour.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/day-service.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/total-price-box2.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/service-other.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/service-include.js') }}"></script>
    <script src="{{ asset('custom/js/my-trip/main.js') }}"></script>
@endsection
