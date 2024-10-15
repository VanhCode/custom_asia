@extends('admin.layouts.main')
@section('title', 'Danh sách Tour')
@section('css')
    <style>
        .table-scroll {
            max-height: 500px;
            /* Giới hạn chiều cao */
            overflow-y: auto;
            /* Thanh cuộn dọc */
        }

        .box-wrap-info {
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
            /* Màu nền nhạt */
            color: #ff0000;
            /* Màu chữ đỏ */
            padding: 15px 20px;
            text-align: center;
            border-radius: 10px;
            /* Bo tròn góc */
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Đổ bóng */
            max-width: 400px;
            /* Giới hạn chiều rộng */
            margin: 20px auto;
            /* Căn giữa */
            border: 2px solid #ff6666;
            /* Viền màu nổi */
        }
    </style>
@endsection
@section('control')
    <a href="{{ route('admin.product.create') }}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
@endsection
@php
    if (session()->has('page')) {
        session()->forget('page');
    }

    session()->put('page', request()->query('page') ? request()->query('page') : 1);
@endphp
@section('content')
    <div class="content-wrapper lb_template_list_product">

        @include('admin.partials.content-header', ['name' => 'Tour', 'key' => 'Danh sách Tour'])
        <!-- Main content -->
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
                            <a href="{{ route('admin.product.create') }}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                            {{-- <div class="group-button-right d-flex">
                        <form action="{{route('admin.product.import.excel.database')}}" class="form-inline" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="max-width: 250px">
                                <input type="file" class="form-control-file" name="fileExcel" accept=".xlsx" required>
                              </div>
                            <input type="submit" value="Import Execel" class=" btn btn-info ml-1">
                        </form>
                        <form class="form-inline ml-3" action="{{route('admin.product.export.excel.database')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="submit" value="Export Execel" class=" btn btn-danger">
                        </form>
                    </div> --}}
                        </div>

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="card-tools w-100 mb-3">
                                    <form action="{{ route('admin.product.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="form-group col-md-3 mb-0">
                                                        <input id="keyword" value="{{ $keyword }}" name="keyword"
                                                            type="text" class="form-control" placeholder="Từ khóa">
                                                        <div id="keyword_feedback" class="invalid-feedback">

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="order" name="order_with" class="form-control">
                                                            <option value="">-- Sắp xếp theo --</option>
                                                            <option value="dateASC"
                                                                {{ $order_with == 'dateASC' ? 'selected' : '' }}>Ngày tạo
                                                                tăng
                                                                dần</option>
                                                            <option value="dateDESC"
                                                                {{ $order_with == 'dateDESC' ? 'selected' : '' }}>Ngày tạo
                                                                giảm
                                                                dần</option>
                                                            <option value="viewASC"
                                                                {{ $order_with == 'viewASC' ? 'selected' : '' }}>Lượt xem
                                                                tăng
                                                                dần</option>
                                                            <option value="viewDESC"
                                                                {{ $order_with == 'viewDESC' ? 'selected' : '' }}>Lượt xem
                                                                giảm
                                                                dần</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="" name="fill_action" class="form-control">
                                                            <option value="">-- Lọc --</option>
                                                            <option value="hot"
                                                                {{ $fill_action == 'hot' ? 'selected' : '' }}>Tour hot
                                                            </option>
                                                            <option value="no_hot"
                                                                {{ $fill_action == 'no_hot' ? 'selected' : '' }}>Tour
                                                                không
                                                                hot</option>
                                                            <option value="active"
                                                                {{ $fill_action == 'active' ? 'selected' : '' }}>Tour hiển
                                                                thị</option>
                                                            <option value="no_active"
                                                                {{ $fill_action == 'no_active' ? 'selected' : '' }}>Tour bị
                                                                ẩn</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-0" style="min-width:100px;">
                                                        <select id="categoryProduct" name="category" class="form-control">
                                                            <option value="">-- Tất cả danh mục --</option>
                                                            {{-- <option value="-1" {{ $status==0? 'selected':'' }}>Đơn hàng đã hủy</option> --}}
                                                            {!! $option !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 mb-0">
                                                <button type="submit" class="btn btn-success w-100">Tìm</button>
                                            </div>
                                            <div class="col-md-1 mb-0">
                                                <a class="btn btn-danger w-100"
                                                    href="{{ route('admin.product.index') }}">Làm mới</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-tools text-right pl-3 pr-3 pt-2 pb-2">
                                <div class="count">
                                    Tổng số bản ghi <strong>{{ $data->count() }}</strong> / {{ $totalProduct }}
                                </div>
                            </div>
                            <div class="card-body table-responsive  lb-list-category">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="table-scroll">
                                            <table class="table table-bordered" id="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Tên</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data) && $data->count() > 0)
                                                        @foreach ($data as $index => $item)
                                                            <tr data-id="{{ $item->id }}">
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>
                                                                    <a data-url="{{ route('admin.product.destroy', ['id' => $item->id]) }}"
                                                                        class="btn btn-sm btn-danger lb_delete"><i
                                                                            class="far fa-trash-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="box-wrap-info">
                                            <div class="tour-message">
                                                Chưa có Tour nào được chọn !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        {{ $data->appends(request()->input())->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

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
                            url: "{{ route('admin.product.multiple_product_delete') }}",
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
        });
    </script>

@endsection
