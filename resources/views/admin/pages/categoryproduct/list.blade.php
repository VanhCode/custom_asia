@extends('admin.layouts.main')
@section('title', 'Danh sách danh mục tour')
@section('css')
    <style>
        .card-header {
            color: #4c4d5a;
            border-color: #dcdcdc;
            background: #f6f6f6;
            text-shadow: 0 -1px 0 rgb(50 50 50 / 0%);
        }

        .title-card-recusive {
            font-size: 13px;
            background: #ECF0F5;
        }

        .lb_list_category {
            font-size: 13px;
            margin-bottom: 0;
        }

        .fa-check-circle {
            color: #169F85;
            font-size: 18px;
        }

        .fa-check-circle {
            color: #169F85;
            font-size: 18px;
        }

        .fa-times-circle {
            color: #f23b3b;
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Danh mục tour',
            'key' => 'Danh sách danh mục',
        ])

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
                        <div class="d-flex justify-content-end">
                            <div class="text-right w-100">
                                <a href="{{ route('admin.categoryproduct.create', ['parent_id' => request()->parent_id ?? 0]) }}"
                                    class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                            </div>
                            {{-- <!--<div class="group-button-right d-flex">
                        <form action="{{route('admin.categoryproduct.import.excel.database')}}" class="form-inline" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="max-width: 250px">
                                <input type="file" class="form-control-file" name="fileExcel" accept=".xlsx" required>
                              </div>
                            <input type="submit" value="Import Execel" class=" btn btn-info ml-1">
                        </form>
                        <form class="form-inline ml-3" action="{{route('admin.categoryproduct.export.excel.database')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="submit" value="Export Execel" class=" btn btn-danger">
                        </form>
                    </div>--> --}}
                        </div>

                        <div class="card card-outline card-info">
                            <div class="card-header pt-2 pb-2">
                                <div class="cart-title">
                                    <i class="fas fa-list"></i> Danh mục
                                </div>
                            </div>
                        </div>
                        @if (isset($parentBr) && $parentBr)
                            <ol class="breadcrumb">
                                <li><a href="{{ route('admin.categoryproduct.index', ['parent_id' => 0]) }}">Root</a></li>

                                @foreach ($parentBr->breadcrumb as $item)
                                    <li><a
                                            href="{{ route('admin.categoryproduct.index', ['parent_id' => $item['id']]) }}">{{ $item['name'] }}</a>
                                    </li>
                                @endforeach
                                <li><a
                                        href="{{ route('admin.categoryproduct.index', ['parent_id' => $parentBr->id]) }}">{{ $parentBr->name }}</a>
                                </li>
                            </ol>
                        @endif

                        <div class="card card-outline card-primary">
                            <div class="card-body table-responsive lb-list-category" style="padding: 0; font-size:13px;">
                                @include('admin.components.category', [
                                    'data' => $data,
                                    'routeNameEdit' => 'admin.categoryproduct.edit',
                                    'routeNameAdd' => 'admin.categoryproduct.create',
                                    'routeNameDelete' => 'admin.categoryproduct.destroy',
                                    'routeNameOrder' => 'admin.loadOrderVeryModel',
                                    'routeLoadHot' => 'admin.categoryproduct.load.hot',
                                    'routeLoadActive' => 'admin.categoryproduct.load.active',
                                    'table' => 'category_products',
                                ])
                            </div>

                            @if (isset($product) && request()->input('parent_id') != 0)
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
                                                <th>Vị trí</th>
                                                <th>Tên</th>
                                                <th class="white-space-nowrap">Hình ảnh</th>
                                                <th class="white-space-nowrap">Active</th>
                                                <th class="white-space-nowrap">Nổi bật</th>
                                                <th class="white-space-nowrap">Danh mục</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable">
                                            @foreach ($product as $key => $productItem)
                                                <tr class="ui-state-default" data-id="{{ $productItem->id }}">
                                                    <td><input type="checkbox" class="checkbox"
                                                            data-id="{{ $productItem->id }}"></td>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    {{-- <td>{{ $productItem->order }}</td> --}}
                                                    <td>{{ $productItem->name }}</td>
                                                    <td>
                                                        <img src="{{ $productItem->avatar_path ? asset($productItem->avatar_path) : $shareFrontend['noImage'] }}"
                                                            alt="{{ $productItem->name }}" style="width:80px;">
                                                    </td>
                                                    <td class="wrap-load-active"
                                                        data-url="{{ route('admin.product.load.active', ['id' => $productItem->id]) }}">
                                                        @include('admin.components.load-change-active', [
                                                            'data' => $productItem,
                                                            'type' => 'sản phẩm',
                                                        ])
                                                    </td>
                                                    <td class="wrap-load-hot"
                                                        data-url="{{ route('admin.product.load.hot', ['id' => $productItem->id]) }}">
                                                        @include('admin.components.load-change-hot', [
                                                            'data' => $productItem,
                                                            'type' => 'sản phẩm',
                                                        ])
                                                    </td>
                                                    <td>{{ optional($productItem->category)->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.product.edit', ['id' => $productItem->id]) }}"
                                                            class="btn btn-sm btn-info"
                                                            onclick="localStorage.setItem('urlListProduct', window.location.href);"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a data-url="{{ route('admin.product.destroy', ['id' => $productItem->id]) }}"
                                                            class="btn btn-sm btn-danger lb_delete"><i
                                                                class="far fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <ul id="sortable">
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        1</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        2</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        3</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        4</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        5</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        6</li>
                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item
                                        7</li>
                                </ul> --}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{ $data->appends(request()->all())->links() }}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <input type="hidden" id="id_cate" value="{{ request()->input('parent_id') }}">

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                change: function(event, ui) {

                },
                update: function(event, ui) {
                    var ids = [];
                    var category_id = document.getElementById('id_cate').value;
                    $("#sortable tr").each(function() {
                        ids.push($(this).data('id'));
                    });
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('updateOrder') }}',
                        data: {
                            category_id: category_id,
                            ids: ids,
                        },
                        success: function(response) {
                            $('#sortable').html(response.html);
                        },
                        error: function(error) {

                        },
                    })
                    console.log(ids);
                    // Bạn có thể sử dụng mảng ids ở đây cho mục đích của mình
                },
            });
        });
    </script>
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
        });
    </script>
@endsection
