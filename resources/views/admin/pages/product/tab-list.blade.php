@extends('admin.layouts.main')
@section('title', 'Danh sách điểm đến')
@section('css')
    <style>
        .card-body {
            overflow-x: hidden
        }

        .form-horizontal .control-label {
            text-align: left
        }

        .wrap-add-btn {
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-primary.card-outline {
            border-top: none
        }

        .card-outline {
            margin-top: 5px
        }

        .card-body {
            padding: 0;
        }

        .btn-confirm {
            margin-top: 27px
        }

        .wrap-btn-confirm {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <style>
        .table-scroll {
            max-height: 500px;
            /* Giới hạn chiều cao */
            overflow-y: auto;
            /* Thanh cuộn dọc */
        }

        .box-wrap-info-2 {
            max-height: 500px;
            /* Giới hạn chiều cao */
            overflow-y: auto;
            overflow-x: hidden;
            /* Thanh cuộn dọc */
        }

        /* Bo góc cho bảng và các ô */
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Đổi màu hàng đầu */
        thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        /* Đổi màu các hàng xen kẽ */
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Hiệu ứng khi hover */
        tbody tr:hover {
            background-color: #d1ecf1;
        }

        tbody tr {
            cursor: pointer;
        }

        tbody tr.active {
            background-color: #118195;
            color: #fff
        }

        /* Bo góc của bảng */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        /* Tô viền dưới của hàng đầu */
        thead th {
            border-bottom: 2px solid #333;
        }

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

        .card-body.p-0 .table tbody>tr>td:first-of-type,
        .card-body.p-0 .table tbody>tr>th:first-of-type,
        .card-body.p-0 .table tfoot>tr>td:first-of-type,
        .card-body.p-0 .table tfoot>tr>th:first-of-type,
        .card-body.p-0 .table thead>tr>td:first-of-type,
        .card-body.p-0 .table thead>tr>th:first-of-type {
            padding-left: 11px;
        }
    </style>
@endsection
@section('control')
    <a href="{{ route('admin.product.create') }}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
@endsection
@section('content')
    <div class="content-wrapper lb_template_list_product">

        @include('admin.partials.content-header', ['name' => 'điểm đến', 'key' => 'Danh sách điểm đến'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('alert'))
                            <div class="alert alert-success">
                                {{ session('alert') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between ">
                            <a href="{{ route('admin.product.edit', ['id' => request()->product_id]) }}"
                                class="btn btn-info btn-md mb-2">Go to tour
                                detail</a>
                            {{-- <a href="{{ route('admin.product.edit', ['id' => $product_id]) }}"
                                class="btn ml-2 btn-info btn-md mb-2">Sửa thông tin Tour</a> --}}
                        </div>
                        <div class="card card-outline card-primary">
                            <div class="card-body table-responsive p-0 lb-list-category">
                                <div class="row mt-3 px-3">
                                    <div class="col-4">
                                        <div class="table-scroll">

                                            <table class="table table-head-fixed" style="font-size: 13px;" id="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Tên</th>
                                                        {{-- <th class="white-space-nowrap">Hình ảnh</th> --}}
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $tabItem)
                                                        <tr data-id="{{ $tabItem->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $tabItem->name . ' ' . $tabItem->description }}</td>
                                                            {{-- <td>
                                                            <img src="{{ $tabItem->avatar_path ? asset($tabItem->avatar_path) : $shareFrontend['noImage'] }}"
                                                                alt="{{ $tabItem->name }}" style="width:80px;">
                                                        </td> --}}
                                                            <td>
                                                                {{-- <a href="{{ route('admin.product.tab.edit', ['id' => $tabItem->id]) }}"
                                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a> --}}
                                                                <a data-url="{{ route('admin.product.destroyTab', ['id' => $tabItem->id]) }}"
                                                                    class="btn btn-sm btn-danger lb_delete"><i
                                                                        class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="wrap-add-btn">
                                            <a href="{{ route('admin.product.tab.create', ['product_id' => $product_id]) }}"
                                                class="btn btn-info btn-md mb-2">+ Thêm mới</a>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="box-wrap-info">
                                            <div class="tour-message">
                                                Chưa có điểm đến nào được chọn nào được chọn !
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const dataTable = document.querySelector('#data-table');
        const rowsTable = document.querySelectorAll('#data-table tbody tr');
        rowsTable.forEach(item => {
            item.onclick = function() {
                rowsTable.forEach(ele => ele.classList.remove('active'));
                this.classList.add('active');
                let url = "{{ route('admin.product.show', ['id' => ':id']) }}";
                url = url.replace(':id', this.dataset.id);
                $.ajax({
                    type: "GET",
                    url,
                    success: function({
                        status,
                        html
                    }) {
                        if (status === 200) {
                            $('.box-wrap-info').html(html);
                        }
                    }
                })
            }
        })
    </script>
@endsection
