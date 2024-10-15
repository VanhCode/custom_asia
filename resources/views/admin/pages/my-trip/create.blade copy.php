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
            <section class="form">
                <div style="--w-lg: 9; --w-xs: 12; margin: 0 auto">
                    <h2 class="title__form tt-up ta-center">
                        Itinerary Builder
                    </h2>
                    <div class="row">

                        <div class="clm" style="--w-lg: 3; --w-md: 6; --w-xs: 12;">
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id="" placeholder="Tên Tour"
                                    value="{{ isset($booking) ? $booking->name : '' }}" readonly>
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id="" placeholder="Tour Code"
                                    value="{{ isset($booking) ? $booking->code : '' }}" readonly>
                            </div>
                            <div class="form-group">
                                <input class="w-100" min="0" type="number" name="" id="number_day"
                                    placeholder="Số Ngày">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="date" name="" id="date_start" min
                                    placeholder="Ngày Đi Tour">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id="" placeholder="Hạng Tour">
                            </div>
                        </div>
                        <div class="clm" style="--w-lg: 7; --w-md: 6; --w-xs: 12;">
                            <div class="row js-center">
                                <div class="clm" style="--w-lg: 8;">
                                    <div class="row">
                                        <div class="clm" style="--w-lg: 6;">
                                            <div class="form-group d-flex">
                                                <input class="flex-1" type="text" name="" id=""
                                                    placeholder="Xưng danh" readonly
                                                    value="{{ isset($booking) ? $booking->customer_title : '' }}">

                                            </div>
                                        </div>
                                        <div class="clm" style="--w-lg: 6;">
                                            <div class="form-group d-flex">
                                                <input class="flex-1" type="text" name="" id=""
                                                    placeholder="First Name" readonly
                                                    value="{{ isset($booking) ? $booking->customer_first_name : '' }}">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id="" readonly
                                            placeholder="Quốc Tịch" value="{{ isset($booking) ? $booking->country : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id="" readonly
                                            placeholder="Điện thoại" value="{{ isset($booking) ? $booking->phone : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id="" readonly
                                            placeholder="Email" value="{{ isset($booking) ? $booking->email : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id=""
                                            placeholder="Loại Hình Tour">
                                    </div>
                                </div>
                                <div class="clm" style="--w-lg: 3;">
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id=""
                                            placeholder="Last Name" readonly
                                            value="{{ isset($booking) ? $booking->customer_last_name : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id="number_adult"
                                            placeholder="Số Người Lớn" readonly
                                            value="{{ isset($booking) ? $booking->amount_customer : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="number" name="" id=""
                                            placeholder="Số Trẻ Con (<12)">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id=""
                                            placeholder="Danh sách đoàn">
                                    </div>
                                    <div class="form-group">
                                        <input class="w-100" type="text" name="" id=""
                                            placeholder="Nguồn">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clm" style="--w-lg: 2; --w-xs: 12;">
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id=""
                                    placeholder="Thị Trường">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id=""
                                    placeholder="Phòng Ban">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id=""
                                    placeholder="Đội Nhóm">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id=""
                                    placeholder="Ngôn Ngữ Thị Trường">
                            </div>
                            <div class="form-group">
                                <input class="w-100" type="text" name="" id=""
                                    placeholder="Giai Đoạn Thực Hiện ">
                            </div>
                        </div>
                        <div class="clm" style="--w-lg: 12; --w-xs: 12;">
                            <div class="form-group">
                                <textarea class="w-100" name="" id="" cols="30" rows="6"></textarea>
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
                            <button>Xem yêu cầu gốc</button>
                        </div>
                        <div class="check-btn ta-center">
                            <button>Nhân bản Tour Này</button>
                        </div>
                    </div>
                    <div class="clm" style="--w-xl: 8;  --w-md: 6; --w-xs: 12;">
                        <div class="check-img" id="thumbnail-wrapper">
                            <img class="d-block img-thumbnail"
                                src="https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png"
                                alt="">
                            <div style="display: none">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a data-input="img-thumbnail-input" data-preview="img-thumbnail"
                                            class="btn btn-primary" id="img-thumbnail">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="img-thumbnail-input" class="form-control" type="text" name="filepath">
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
                                        <th class="ta-center service-full-total-price">0 VND</th>
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
                                    {{-- <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                        <span>Hanoi city tour</span>
                                    </li>
                                    <div>
                                        <li>
                                            <span>Day 1</span>
                                            [Web,Aug 28,2024]
                                            <span>Hanoi city tour</span>
                                        </li>
                                        <div class="list-tour-ad-desc">
                                            <div class="desc">
                                                <p>
                                                    Welcome to Vietnam! Upon your arrival at Noi Bai Airport, a private
                                                    driver
                                                    will pick you up and take you to your hotel in the center of Hanoi.
                                                    After
                                                    checking in, you can relax and get familiar with the city. Take a stroll
                                                    around the neighborhood or enjoy the hotel's facilities. In the evening,
                                                    explore Hanoi's culinary scene, walk around Hoan Kiem Lake, or simply
                                                    unwind
                                                    at the hotel. Get a good night's rest to prepare for your cycling
                                                    adventures
                                                    the next day.
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                    <img src="https://images.pexels.com/photos/147411/italy-mountains-dawn-daybreak-147411.jpeg?cs=srgb&amp;dl=pexels-pixabay-147411.jpg&amp;fm=jpg"
                                                        alt="">
                                                </div>
                                                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                    <img src="https://images.pexels.com/photos/147411/italy-mountains-dawn-daybreak-147411.jpeg?cs=srgb&amp;dl=pexels-pixabay-147411.jpg&amp;fm=jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <table class="w-100">

                                                <thead>
                                                    <tr>
                                                        <th style="width: 45px;">+</th>
                                                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                                        <th class="ta-center tt-up">Tên gói</th>
                                                        <th class="ta-center tt-up">Tổng giá</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td class="ta-center">-</td>
                                                        <td>
                                                            <select name="" id="">
                                                                <option value="">Xe riêng</option>
                                                            </select>
                                                        </td>
                                                        <td class="ta-center">CV05</td>
                                                        <td class="ta-center">1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ta-center">-</td>
                                                        <td>
                                                            <select name="" id="">
                                                                <option value="">Xe riêng</option>
                                                            </select>
                                                        </td>
                                                        <td class="ta-center">CV05</td>
                                                        <td class="ta-center">1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ta-center">-</td>
                                                        <td>
                                                            <select name="" id="">
                                                                <option value="">Xe riêng</option>
                                                            </select>
                                                        </td>
                                                        <td class="ta-center">CV05</td>
                                                        <td class="ta-center">1000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                        <span>Hanoi city tour</span>
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                        <span>Hanoi city tour</span>
                                    </li>
                                    <li>
                                        <span>Day 1</span>
                                        [Web,Aug 28,2024]
                                        <span>Hanoi city tour</span>
                                    </li> --}}
                                </div>
                                <table class="w-100  table-2">
                                    <tbody>
                                        <tr>
                                            <td>
                                                Tổng chi phí chung
                                            </td>
                                            <td class="ta-center" style="width: 450px;"></td>
                                            <td class="ta-center total-price-box-1 service-full-total-price"
                                                style="width: 130px;">0 VND</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tổng chi phí dịch vụ lẻ từng ngày
                                            </td>
                                            <td class="ta-center" style="width: 450px;"></td>
                                            <td class="ta-center total-price-box-1 service-individual-total-price">0 VND
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="ta-left">Chi Phí tour
                                            </th>
                                            <th>
                                                <input type="number" value="0" min="0"
                                                    class="result-price-box-1-percent">%
                                            </th>
                                            <th class="ta-center total-price-box result-price-box-1"
                                                data-hidden="input-hidden-box-1" data-limit="0" data-price="0">0 VND
                                            </th>
                                            <input type="hidden" class="price-total-item input-hidden-box-1"
                                                data-price="0">
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
                                                    </td>
                                                    <td class="ta-center" style="width: 450px;">
                                                        <input type="number" class="price-tour-box-2-percent"
                                                            value="0" min="0" data-limit="0"
                                                            data-target="price-tour-box-2-percent-{{ $type->id }}"
                                                            data-input="{{ $type->id }}">%
                                                    </td>
                                                    <td class="ta-center price-tour-box-2 price-tour-box-2-percent-{{ $type->id }}"
                                                        data-target="price-tour-box-2-{{ $type->id }}"
                                                        style="width: 130px;" data-price="0">0 VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="ta-left ">Giá tour
                                                </th>
                                                <th class="ta-center total-price-tour-box-2-one" data-price="0">0 VND /
                                                    NGƯỜI</th>
                                                <th class="ta-center price-total-item total-price-box total-price-tour-box-2"
                                                    data-target="total-price-tour-box-2-one" data-price="0">0 VND</th>
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
                                            <th class="ta-center total-price-service-other-one">
                                                0 VND/ người
                                            </th>
                                            <th class="ta-center price-total-item total-price-service-other">0 VND</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <table class="w-100 table-3">
                                    <tfoot>
                                        <tr>
                                            <th class="ta-left">Tổng chi phí
                                            </th>
                                            <th style="width: 450px;" class="ta-center total-price-final-one">
                                                0 VND/ người
                                            </th>
                                            <th class="ta-center total-price-final" style="width: 130px;">0 VND
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="table-service">
                                    <div class="row">
                                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                            <table class="w-100">

                                                <thead>
                                                    <tr>
                                                        <th style="width: 45px;">+</th>
                                                        <th class="tt-up">Dịch vụ bao gồm</th>
                                                    </tr>
                                                </thead>

                                                {{-- <tbody>
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
                                                    </tr>
                                                    <tr>
                                                        <td class="ta-center">-</td>
                                                        <td>Xe riêng chỗ</td>
                                                    </tr>
                                                </tbody> --}}
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <textarea class="ckeditor" id="editor"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>


                                            </table>
                                        </div>
                                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                            <table class="w-100">

                                                <thead>
                                                    <tr>
                                                        <th style="width: 45px;">+</th>
                                                        <th class="tt-up">Dịch vụ không bao gồm</th>
                                                    </tr>
                                                </thead>

                                                {{-- <tbody>
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
                                                    </tr>
                                                    <tr>
                                                        <td class="ta-center">-</td>
                                                        <td>Xe riêng chỗ</td>
                                                    </tr>
                                                </tbody> --}}
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <textarea class="ckeditor" id="editor1"></textarea>
                                                        </td>
                                                    </tr>
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
        </main>

    </div>
@endsection
@section('js')
    <script>
        const serviceFullTour = @json($serviceFullTour);
        const serviceTour = @json($serviceTour);
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
    <script src="{{ asset('custom/js/my-trip/main.js') }}"></script>
@endsection
