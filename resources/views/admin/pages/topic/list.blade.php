@extends('admin.layouts.main')
@section('title', 'Danh sách Chủ đề')

@section('css')

@endsection
@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Chủ đề',
            'key' => 'Danh sách Chủ đề',
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
                            <a href="{{ route('admin.topic.create', ['parent_id' => request()->parent_id ?? 0]) }}"
                                class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                        </div>
                        <div class="card card-outline card-info">
                            <div class="card-header pt-2 pb-2">
                                <div class="cart-title">
                                    <i class="fas fa-list"></i> Chủ đề
                                </div>
                            </div>
                        </div>

                        @if (isset($parentBr) && $parentBr)
                            <ol class="breadcrumb">
                                <li><a href="{{ route('admin.topic.index', ['parent_id' => 0]) }}">Root</a></li>

                                @foreach ($parentBr->breadcrumb as $item)
                                    <li><a
                                            href="{{ route('admin.topic.index', ['parent_id' => $item['id']]) }}">{{ $item['name'] }}</a>
                                    </li>
                                @endforeach

                                <li><a
                                        href="{{ route('admin.topic.index', ['parent_id' => $parentBr->id]) }}">{{ $parentBr->name }}</a>
                                </li>
                            </ol>
                        @endif
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
                                                    {{-- <div class="col-sm-2 pt-2 pb-2 slug text-center">
                                                        Nổi bật
                                                    </div> --}}
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
                                    @foreach ($data as $value)
                                        <li class="lb_item_recusive font-weight-bold  lb_item_delete  border-bottom">
                                            <div class="d-flex">
                                                <div class="box-left lb_list_content_recusive ">
                                                    <div class="d-flex">
                                                        <div class="col-sm-1 pt-2 pb-2 white-space-nowrap folder">
                                                            @if ($value->childs->count())
                                                                <i class="fas fa-folder"></i>
                                                            @else
                                                                <i class="fas fa-file-alt"></i>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-4 pt-2 pb-2 name">
                                                            <a href="{{ route(Route::currentRouteName(), ['parent_id' => $value->id]) }}">{{ $value->name }}</a>
                                                        </div>
                                                        {{-- <div class="col-sm-2  pt-2 pb-2 parent text-center wrap-load-hot" 
                                                            data-url="{{ route('admin.topic.load.hot', ['id' => $value->id]) }}">
                                                            @include('admin.components.load-change-hot',['data'=>$value,'type'=>'topic'])
                                                         </div> --}}
                                                        <div class="col-sm-2 pt-2 pb-2 slug text-center">
                                                            <input
                                                                data-url="{{ route('admin.loadOrderVeryModel', ['table' => 'topics', 'id' => $value->id]) }}"
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
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="pt-1 pb-1 lb_list_action_recusive">
                                                    <a href="{{ route('admin.topic.edit', ['id' => $value->id]) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                    <a data-url="{{ route('admin.topic.destroy', ['id' => $value->id]) }}"
                                                        class="btn btn-sm btn-danger lb_delete_recusive"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </div>
                                            </div>
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
