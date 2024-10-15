@extends('admin.layouts.main')
@section('title', 'Danh sach thuộc tính')

@section('css')

@endsection
@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Thuộc tính',
            'key' => 'Danh sách thuộc tính',
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
                        <div class="text-right">
                            <a href="{{ route('admin.attribute.create', ['parent_id' => request()->parent_id ?? 0]) }}"
                                class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                        </div>
                        <div class="card card-outline card-info">
                            <div class="card-header pt-2 pb-2">
                                <div class="cart-title">
                                    <i class="fas fa-list"></i> Thuộc tính
                                </div>
                            </div>
                        </div>

                        @if (isset($parentBr) && $parentBr)
                            <ol class="breadcrumb">
                                <li><a href="{{ route('admin.attribute.index', ['parent_id' => 0]) }}">Root</a></li>

                                @foreach ($parentBr->breadcrumb as $item)
                                    <li><a
                                            href="{{ route('admin.attribute.index', ['parent_id' => $item['id']]) }}">{{ $item['name'] }}</a>
                                    </li>
                                @endforeach

                                <li><a
                                        href="{{ route('admin.attribute.index', ['parent_id' => $parentBr->id]) }}">{{ $parentBr->name }}</a>
                                </li>
                            </ol>
                        @endif
                        <div class="card card-outline card-primary">
                            <div class="card-body table-responsive lb-list-category">
                                {{-- @include('admin.components.category', [
                                    'data' => $data,
                                    'routeNameEdit' => 'admin.attribute.edit',
                                    'routeNameAdd' => 'admin.attribute.create',
                                    'routeNameDelete' => 'admin.attribute.destroy',
                                    'routeNameOrder' => 'admin.loadOrderVeryModel',
                                    'routeLoadActive' => 'admin.attribute.edit',
                                    'routeLoadHot' => 'admin.attribute.edit',
                                    'table' => 'attributes',
                                ]) --}}




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
                                                    {{-- <div class="col-sm-3 pt-2 pb-2 parent text-center">
                                                        Trạng thái
                                                    </div>
                                                    <div class="col-sm-2 pt-2 pb-2 parent text-center">
                                                        Nổi bật
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="pt-2 pb-2 lb_list_action_recusive">
                                                Tác Vụ
                                            </div>
                                        </div>
                                    </li>
                                    @foreach ($data as $value)
                                        <li class="lb_item_recusive font-weight-bold  lb_item_delete  border-bottom">
                                            <div class="d-flex">
                                                <div class="box-left lb_list_content_recusive ">
                                                    <div class="d-flex">
                                                        <div class="col-sm-1 pt-2 pb-2 white-space-nowrap folder">
                                                            {{-- {{$value->id}} --}}
                                                            @if ($value->childs->count())
                                                                <i class="fas fa-folder"></i>
                                                            @else
                                                                <i class="fas fa-file-alt"></i>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-4 pt-2 pb-2 name">
                                                            <a
                                                                href="{{ route(Route::currentRouteName(), ['parent_id' => $value->id]) }}">{{ $value->name }}</a>

                                                        </div>
                                                        <div class="col-sm-2 pt-2 pb-2 slug text-center">
                                                            <input
                                                                data-url="{{ route('admin.loadOrderVeryModel', ['table' => 'attributes', 'id' => $value->id]) }}"
                                                                class="lb-order text-center" type="number" min="0"
                                                                value="{{ $value->order ? $value->order : 0 }}"
                                                                style="width:50px" />
                                                        </div>
                                                        {{-- <div class="col-sm-3  pt-2 pb-2 parent text-center wrap-load-active"
                                                            data-url="{{ route($routeLoadActive, ['id' => $value->id]) }}">
                                                            @include(
                                                                'admin.components.load-change-active',
                                                                ['data' => $value, 'type' => 'danh mục']
                                                            )
                                                        </div>
                                                        <div class="col-sm-2  pt-2 pb-2 parent text-center wrap-load-hot"
                                                            data-url="{{ route($routeLoadHot, ['id' => $value->id]) }}">
                                                            @include('admin.components.load-change-hot', [
                                                                'data' => $value,
                                                                'type' => 'danh mục',
                                                            ])
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="pt-1 pb-1 lb_list_action_recusive">
                                                    <a href="{{ route('admin.attribute.edit', ['id' => $value->id]) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.attribute.create', ['parent_id' => $value->id]) }}"
                                                        class="btn btn-sm btn-info">+ Thêm</a>
                                                    <a data-url="{{ route('admin.attribute.destroy', ['id' => $value->id]) }}"
                                                        class="btn btn-sm btn-danger lb_delete_recusive"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    {{-- @if ($value->childs->count())
                                                        <button type="button" class="btn btn-sm btn-primary lb-toggle">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    @endif --}}
                                                </div>
                                            </div>
                                            {{-- @if ($value->childs->count())
                                                <ul class="font-weight-normal" style="display: none;">
                                                    @foreach ($value->childs as $childValue)
                                                        @include('admin.components.category-child', [
                                                            'childs' => $childValue,
                                                        ])
                                                    @endforeach
                                                </ul>
                                            @endif --}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
