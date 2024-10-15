@extends('admin.layouts.main')
@section('title', 'Thêm tour')
@section('css')
    <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .delete-avatar {
            cursor: pointer;
        }

        .preview-avatar {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            background-color: #0000000f;
            border-radius: 5px;
            overflow: hidden;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
        }

        .select2-container .select2-selection--single {
            height: auto;
        }

        .tinymce_editor_init {
            height: 300px !important;
        }

        .load-multiple-img2>img {
            width: 32%;
            border: 1px solid #eee;
            padding: 5px;
        }
    </style>
    <style>
        .col-image {
            position: relative;
        }

        .col-image input {
            position: absolute;
            width: 35px;
        }

        .image-list-small {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 auto;
            text-align: center;
            max-width: 640px;
            padding: 0;
        }

        .image-list-small li {
            display: inline-block;
            width: 181px;
            margin: 0 12px 30px;
        }


        /* Photo */

        .image-list-small li>a {
            display: block;
            text-decoration: none;
            background-size: cover;
            background-repeat: no-repeat;
            height: 137px;
            margin: 0;
            padding: 0;
            border: 4px solid #ffffff;
            outline: 1px solid #d0d0d0;
            box-shadow: 0 2px 1px #DDD;
        }

        .image-list-small .details {
            margin-top: 13px;
        }


        /* Title */

        .image-list-small .details h3 {
            display: block;
            font-size: 12px;
            margin: 0 0 3px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-list-small .details h3 a {
            color: #303030;
            text-decoration: none;
        }

        .image-list-small .details .image-author {
            display: block;
            color: #717171;
            font-size: 11px;
            font-weight: normal;
            margin: 0;
        }

        /* map */
        #map {
            height: 500px;
            width: 100%;
        }

        .list-destination {
            margin-bottom: 0px;
        }

        .list-destination li {
            padding: 8px 10px;
            border-bottom: 1px solid #e8e8e8;
            cursor: pointer;
        }

        .list-destination li:last-child {
            border-bottom: unset
        }

        .list-destination li span {
            font-size: 14px;
            color: #000000A6
        }

        .list-destination li img {
            height: 21px;
            width: 21px;
        }

        .br-3 {
            border-radius: 3px
        }

        .ml-8 {
            margin-left: 8px
        }

        .mr-8 {
            margin-right: 8px
        }

        .trash-destination {
            display: none;
        }

        .list-destination li:hover .trash-destination {
            display: block;
            cursor: pointer;
            z-index: 100;
        }

        .move-destination {
            cursor: move
        }

        .info-location {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 24px;
        }

        .option-location:hover {
            background-color: #f0fcff;
            border: rgb(179, 214, 233);
            color: #000
        }


        .form-input-search {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            box-shadow: none;
            transition: all .3s cubic-bezier(.645, .045, .355, 1), height 0s;
        }

        .icon-input-search {
            position: absolute;
            top: 50%;
            left: 2%;
            z-index: 2;
            display: flex;
            align-items: center;
            color: rgba(0, 0, 0, .65);
            line-height: 0;
            transform: translateY(-50%);
        }

        #search {
            padding-left: 34px
        }

        .ui-widget-content.ui-autocomplete {
            max-height: 400px;
            overflow-x: auto;
        }

        .form-group__img {
            position: relative;
            margin-top: 15px;
        }

        .form-group__delete {
            position: absolute;
            right: 1px;
            top: 1px;
            height: 35px;
            width: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ce2033;
            border: 3px solid white;
        }

        .form-group__delete svg {
            height: 15px;
            fill: white;
        }

        .form-group .row .form-group__img {
            padding: 2px;
            border: 1px solid #d2d2d2;
        }

        .form-group .row .form-group__delete {
            height: 30px;
            width: 30px;
            border: 2px solid white;
        }


        .w-100 {
            width: 100%;
        }

        .d-flex {
            display: flex;
        }

        .flex-1 {
            flex: 1
        }

        .btn {
            height: 30px;
            border-radius: 4px;
            color: white;
            margin-bottom: 10px;
        }

        .btn-build {
            background-color: #2da446;
        }

        .btn-save {
            background-color: #0e808b;
        }

        .btn-back {
            background-color: #1d9ebb;
        }

        .btn-zezo {
            background-color: #a4a4a4;
        }

        .all-image img {
            width: 100%;
            object-fit: contain;
            height: 130px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name' => 'tour', 'key' => 'Thêm tour'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('alert'))
                            <div class="alert alert-success">
                                {{ session()->get('alert') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form class="form-horizontal" id="addProductForm" name="addProduct"
                            action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        @foreach ($errors->all() as $message)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="card-tool p-3 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                        <button type="submit" class="btn btn-warning btn-lg save-draft">Lưu nháp</button>
                                        <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <button class="btn btn-zezo btn-lg w-100 flex-1">

                                    </button>
                                </div>
                                <div class="col-md-2">
                                    {{-- <button type="submit" class="btn btn-build btn-lg w-100">
                                        Itinerary builder
                                    </button> --}}
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-right row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-save btn-lg w-100 flex-1">
                                                Lưu lại thay đổi
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a type="button" class="btn btn-back btn-lg w-100 flex-1"
                                                href="{{ route('admin.product.index') }}">
                                                Về trang danh sách
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-7">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin tour</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng
                                                        quan</a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                                </li> --}}
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#thuoctinh">Thuộc tính</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#seo">Seo</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#category">Lựa chọn chuyên
                                                        mục</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <!-- START Tổng Quan -->
                                                <div id="tong_quan" class="container tab-pane active "><br>
                                                    {{-- <ul class="nav nav-tabs">
                                                        @foreach ($langConfig as $langItem)
                                                            <li class="nav-item">
                                                                <a class="nav-link {{ $langItem['value'] == $langDefault ? 'active' : '' }}"
                                                                    data-toggle="tab"
                                                                    href="#tong_quan_{{ $langItem['value'] }}">{{ $langItem['name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul> --}}
                                                    <div class="tab-content">
                                                        @foreach ($langConfig as $langItem)
                                                            <div id="tong_quan_{{ $langItem['value'] }}"
                                                                class="container wrapChangeSlug tab-pane {{ $langItem['value'] == $langDefault ? 'active show' : '' }} fade">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Tên tour</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control nameChangeSlug
                                                                    @error('name_' . $langItem['value']) is-invalid @enderror"
                                                                                id="name_{{ $langItem['value'] }}"
                                                                                value="{{ old('name_' . $langItem['value']) }}"
                                                                                name="name_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập tên tour">
                                                                            @error('name_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Slug</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control resultSlug
                                                                    @error('slug_' . $langItem['value']) is-invalid  @enderror"
                                                                                id="slug_{{ $langItem['value'] }}"
                                                                                value="{{ old('slug_' . $langItem['value']) }}"
                                                                                name="slug_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập slug">
                                                                            @error('slug_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Tình trạng</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control
                                                                    @error('tinhtrang_' . $langItem['value']) is-invalid @enderror"
                                                                                id="tinhtrang_{{ $langItem['value'] }}"
                                                                                value="{{ old('tinhtrang_' . $langItem['value']) }}"
                                                                                name="tinhtrang_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập tình trạng">
                                                                            @error('tinhtrang_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div> --}}

                                                                {{-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Khuyến mại đặc biệt</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control
                                                                    @error('baohanh_' . $langItem['value']) is-invalid @enderror"
                                                                                id="baohanh_{{ $langItem['value'] }}"
                                                                                value="{{ old('baohanh_' . $langItem['value']) }}"
                                                                                name="baohanh_{{ $langItem['value'] }}"
                                                                                placeholder="Khuyến mại đặc biệt">
                                                                            @error('baohanh_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div> --}}

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Giới thiệu</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control tinymce_editor_init @error('description_' . $langItem['value']) is-invalid @enderror"
                                                                                name="description_{{ $langItem['value'] }}" id="editer3" rows="3" placeholder="Nhập giới thiệu">{{ old('description_' . $langItem['value']) }}</textarea>
                                                                            @error('description_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nội dung</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control tinymce_editor_init @error('content_' . $langItem['value']) is-invalid @enderror"
                                                                                name="content_{{ $langItem['value'] }}" id="editer4" rows="3" placeholder="Nhập nội dung">{{ old('content_' . $langItem['value']) }}</textarea>
                                                                            @error('content_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    {{-- <div class="row">
                                                        <div class="col-md-6">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card-tool p-3 text-right">
                                                                <button type="submit" class="btn btn-primary btn-lg">Chấp
                                                                    nhận</button>
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-lg save-draft">Lưu
                                                                    nháp</button>
                                                                <button type="reset" class="btn btn-danger btn-lg">Làm
                                                                    lại</button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <!-- END Tổng Quan -->

                                                <!-- START Hình Ảnh -->
                                                {{-- <div id="hinh_anh" class="container tab-pane fade"><br>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh đại diện</label>
                                                            <input type="file"
                                                                class="form-control-file img-load-input border @error('avatar_path')
                                                        is-invalid
                                                        @enderror"
                                                                id="" name="avatar_path">
                                                            @error('avatar_path')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh bé</label>
                                                            <input type="file"
                                                                class="form-control-file img-load-input border @error('file')
                                                        is-invalid
                                                        @enderror"
                                                                id="" name="file">
                                                            @error('file')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh to</label>
                                                            <input type="file"
                                                                class="form-control-file img-load-input border @error('file2')
                                                        is-invalid
                                                        @enderror"
                                                                id="" name="file2">
                                                            @error('file2')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>

                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh liên quan</label>
                                                            <input type="file" onchange="upLoad()"
                                                                class="form-control-file img-load-input-multiple border @error('image')
                                                            is-invalid
                                                            @enderror"
                                                                id="imageInput" name="image123[]" multiple>
                                                        </div>
                                                        @error('image')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror

                                                        <div id="customFileInput">
                                                            <input type="text" id="imagePath" name="image_path"
                                                                style="display: none;">
                                                        </div>

                                                        <div class="load-multiple-img1" id="imagePreview">
                                                            <img class="img-first"
                                                                src="{{ asset('admin_asset/images/upload-image.png') }}">
                                                            <img class="img-first"
                                                                src="{{ asset('admin_asset/images/upload-image.png') }}">
                                                            <img class="img-first"
                                                                src="{{ asset('admin_asset/images/upload-image.png') }}">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <!-- END Hình Ảnh -->

                                                <div id="thuoctinh" class="container tab-pane fade">
                                                    <div id="attribute"></div>

                                                    <div class="form-group wrap-permission">
                                                        <div style="border: 1px solid; padding: 5px;">
                                                            <label class="control-label" for="">Lựa chọn thuộc
                                                                tính</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div
                                                                        style="height: 250px; overflow: auto;border: 1px solid #eee;font-size: 12px;line-height: 18px;">
                                                                        @foreach ($attributes as $item)
                                                                            <div class="item-permission mt-2 mb-2">
                                                                                <div class="form-check permission-title">
                                                                                    <label
                                                                                        class="form-check-label p-3">{{ $item->name }}</label>
                                                                                </div>
                                                                                @if (count($item->childs) > 0)
                                                                                    <div class="list-permission p-3 pl-4">
                                                                                        <div class="row">
                                                                                            @foreach ($item->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild)
                                                                                                <div
                                                                                                    class="col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <label
                                                                                                            class="form-check-label">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                class="form-check-input check-attribute check-children"
                                                                                                                name="attribute[]"
                                                                                                                value="{{ $itemChild->id }}">{{ $itemChild->name }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- START Seo -->
                                                <div id="seo" class="container tab-pane fade"><br>
                                                    <ul class="nav nav-tabs">
                                                        @foreach ($langConfig as $langItem)
                                                            <li class="nav-item">
                                                                <a class="nav-link {{ $langItem['value'] == $langDefault ? 'active' : '' }}"
                                                                    data-toggle="tab"
                                                                    href="#seo_{{ $langItem['value'] }}">{{ $langItem['name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content">
                                                        @foreach ($langConfig as $langItem)
                                                            <div id="seo_{{ $langItem['value'] }}"
                                                                class="container tab-pane {{ $langItem['value'] == $langDefault ? 'active show' : '' }} fade">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập title seo</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control @error('title_seo_' . $langItem['value']) is-invalid @enderror"
                                                                                id="title_seo"
                                                                                value="{{ old('title_seo_' . $langItem['value']) }}"
                                                                                name="title_seo_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập title seo">
                                                                            @error('title_seo_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập mô tả seo</label>
                                                                        <div class="col-sm-10">
                                                                            {{-- <input type="text" class="form-control @error('description_seo_' . $langItem['value']) is-invalid @enderror" id="description_seo" value="{{ old('description_seo_' . $langItem['value']) }}" name="description_seo_{{ $langItem['value'] }}" placeholder="Nhập mô tả seo"> --}}
                                                                            <textarea class="form-control @error('description_seo_' . $langItem['value']) is-invalid @enderror"
                                                                                id="description_seo" name="description_seo_{{ $langItem['value'] }}" placeholder="Nhập mô tả seo"
                                                                                rows="3">{{ old('description_seo_' . $langItem['value']) }}</textarea>
                                                                            @error('description_seo_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập từ khóa seo</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control @error('keyword_seo_' . $langItem['value']) is-invalid @enderror"
                                                                                id="keyword_seo"
                                                                                value="{{ old('keyword_seo_' . $langItem['value']) }}"
                                                                                name="keyword_seo_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập mô tả seo">
                                                                            @error('keyword_seo_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập tags</label>
                                                                        <div class="col-sm-10">
                                                                            {{-- {{ dd(old('tags_'.$langItem['value'])) }} --}}
                                                                            <select
                                                                                class="form-control tag-select-choose w-100"
                                                                                multiple="multiple"
                                                                                name="tags_{{ $langItem['value'] }}[]">
                                                                                @if (old('tags_' . $langItem['value']))
                                                                                    @foreach (old('tags_' . $langItem['value']) as $tag)
                                                                                        <option
                                                                                            value="{{ $tag }}"
                                                                                            selected>{{ $tag }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            @error('title_seo')
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                                <!-- END Seo -->

                                                <!-- START Seo -->
                                                <div id="category" class="container tab-pane fade">
                                                    <div class="form-group wrap-permission">
                                                        <div style="border: 1px solid; padding: 5px;">
                                                            <label class="control-label" for="">Lựa chọn chuyên
                                                                mục</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div
                                                                        style="height: 250px; overflow: auto;border: 1px solid #eee;font-size: 12px;line-height: 18px;">
                                                                        @foreach ($data as $item)
                                                                            <div class="item-permission mt-2 mb-2">
                                                                                <div class="form-check permission-title">
                                                                                    <label class="form-check-label p-2">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input check-parent"
                                                                                            value="{{ $item->id }}"
                                                                                            name="category[]">{{ $item->name }}
                                                                                    </label>
                                                                                </div>
                                                                                @if (count($item->childs) > 0)
                                                                                    <div class="list-permission p-2 pl-4">
                                                                                        <div class="row">
                                                                                            @foreach ($item->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild)
                                                                                                <div
                                                                                                    class="col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <label
                                                                                                            class="form-check-label">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                class="form-check-input check-children"
                                                                                                                name="category[]"
                                                                                                                value="{{ $itemChild->id }}">{{ $itemChild->name }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    @if (count($itemChild->childs) > 0)
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            @foreach ($itemChild->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild2)
                                                                                                                <div
                                                                                                                    class="col-lg-12 col-md-12 col-sm-12">
                                                                                                                    <div
                                                                                                                        class="form-check pl-5">
                                                                                                                        <label
                                                                                                                            class="form-check-label">
                                                                                                                            <input
                                                                                                                                type="checkbox"
                                                                                                                                class="form-check-input check-children"
                                                                                                                                name="category[]"
                                                                                                                                value="{{ $itemChild2->id }}">{{ $itemChild2->name }}
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Seo -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="card card-outline card-primary">
                                        {{-- <div class="card-header">
                                            <h3 class="card-title">Thông tin khác</h3>
                                        </div> --}}
                                        <div class="card-body table-responsive p-3">


                                            <div class="form-group">
                                                <label class="control-label" for="">Mã tour</label>
                                                <input type="text" min="0"
                                                    class="form-control  @error('masp') is-invalid  @enderror"
                                                    value="{{ old('masp') }}" name="masp"
                                                    placeholder="Nhập mã tour">
                                                @error('masp')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Loại tour</label>
                                                <input type="text"
                                                    class="form-control
                                                    @error('content2_' . $langItem['value']) is-invalid @enderror"
                                                    id="content2_{{ $langItem['value'] }}"
                                                    value="{{ old('content2_' . $langItem['value']) }}"
                                                    name="content2_{{ $langItem['value'] }}"
                                                    placeholder="Nhập loại tour">
                                                @error('masp')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Thời gian (days)</label>
                                                <input type="number" min="0"
                                                    class="form-control  @error('number') is-invalid  @enderror"
                                                    value="{{ old('number') }}" name="number"
                                                    placeholder="Nhập Thời gian (days)">
                                                @error('number')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Nổi bật</label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox"
                                                            class="form-check-input @error('hot')
                                                        is-invalid
                                                        @enderror"
                                                            value="1" name="hot"
                                                            @if (old('hot') === '1') {{ 'checked' }} @endif>
                                                    </label>
                                                </div>
                                                @error('hot')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Sale</label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox"
                                                            class="form-check-input @error('sale') is-invalid @enderror"
                                                            value="1" name="sale"
                                                            @if (old('sale') === '1') {{ 'checked' }} @endif>
                                                    </label>
                                                </div>
                                                @error('sale')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <div class="form-group">
                                                <label class="control-label" for="">Trạng thái</label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="activeRadio"
                                                            value="1"
                                                            @if (old('active') === '1' || old('active') === null) checked @endif>Hiện
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="activeRadio"
                                                            value="0"
                                                            @if (old('active') === '0') checked @endif>Ẩn
                                                    </label>
                                                </div>
                                                <input type="text" id="activeInput" class="form-check-input"
                                                    value="{{ old('active', '1') }}" name="active"
                                                    style="display: none;">
                                                @error('active')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Giá</label>
                                                {{-- <input type="number" min="0"
                                                    class="form-control  @error('price') is-invalid  @enderror"
                                                    value="{{ old('price') }}" name="price"
                                                    placeholder="Nhập giá"> --}}
                                                <input type="text" id="formattedPrice"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price') }}" placeholder="Nhập giá">
                                                <input type="hidden" name="price" id="price"
                                                    value="{{ old('price') }}">
                                                @error('price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Giá cũ</label>
                                                <input type="text" id="formattedPrice1"
                                                    class="form-control @error('old_price') is-invalid @enderror"
                                                    value="{{ old('old_price') }}" placeholder="Nhập giá cũ">
                                                <input type="hidden" name="old_price" id="old_price"
                                                    value="{{ old('old_price') }}">
                                                @error('old_price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-outline card-primary all-image">
                                        <div class="card-header">
                                            <h3 class="card-title">Hình ảnh</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Thumbnail</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="avatar_path" id="avatar_path">
                                                @error('avatar_path')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="avatar_path">
                                                    <img src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <div class="form-group__delete delete-avatar d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="form-group">
                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Thumbnail</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="avatar_path_id" data-input="avatar_path"
                                                                    data-preview="avatar_path_pr"
                                                                    class="btn btn-primary btn-file-manager">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                            </span>
                                                            <input id="avatar_path" class="form-control input-file-change"
                                                                type="text" name="avatar_path">
                                                        </div>
                                                    </div>
                                                    <div class="avatar_path-preview">
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Image map small</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="file_id" data-input="file"
                                                                    data-preview="file_pr"
                                                                    class="btn btn-primary btn-file-manager">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                            </span>
                                                            <input id="file" class="form-control input-file-change"
                                                                type="text" name="file">
                                                        </div>
                                                    </div>
                                                    <div class="file-preview">
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Image map large</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="file2_id" data-input="file2"
                                                                    data-preview="file2_pr"
                                                                    class="btn btn-primary btn-file-manager">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                            </span>
                                                            <input id="file2" class="form-control input-file-change"
                                                                type="text" name="file2">
                                                        </div>
                                                    </div>
                                                    <div class="file2-preview">
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Mini map image</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="file">
                                                @error('file')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="file">
                                                    <img src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <div class="form-group__delete delete-avatar d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Large map image</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="file2">
                                                @error('file2')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="file2">
                                                    <img src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <div class="form-group__delete delete-avatar d-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="form-group">
                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Gallary</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="gallary_id" data-input="gallary"
                                                                    data-preview="gallary_pr"
                                                                    class="btn btn-primary btn-file-mutiple-manager">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                            </span>
                                                            <input id="gallary"
                                                                class="form-control input-file-mutiple-change"
                                                                type="text" name="gallary">
                                                        </div>
                                                    </div>
                                                    <div class="gallary-mutiple-preview row">
                                                        {{-- <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;"> --}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function handleFileInputChange(inputElementId) {
            var inputElement = document.getElementById(inputElementId);

            inputElement.addEventListener('change', function(event) {
                var fileList = event.target.files;
                // Kiểm tra xem có tệp tin nào được chọn không
                if (fileList.length > 0) {
                    // Kiểm tra xem input đã có các tệp tin được chọn trước đó hay chưa
                    if (inputElement.dataset.initialFiles) {
                        var initialFiles = JSON.parse(inputElement.dataset.initialFiles);
                        // Thêm các tệp tin đã được chọn ban đầu vào danh sách các tệp tin mới
                        for (var i = 0; i < initialFiles.length; i++) {
                            fileList[fileList.length] = initialFiles[i];
                        }
                    }
                    // Lưu danh sách các tệp tin đã được chọn vào thuộc tính data của input
                    inputElement.dataset.initialFiles = JSON.stringify(fileList);
                }
            });
        }
        // handleFileInputChange('file-input');
    </script>

    <script>
        $(document).ready(function() {
            // Cập nhật giá trị input ẩn dựa trên lựa chọn của radio button
            $('input[type=radio][name=activeRadio]').change(function() {
                $('#activeInput').val(this.value);
            });
        });
    </script>

    <script>
        var selectedFiles = [];

        function upLoad() {
            var input = document.getElementById('imageInput');
            var previewDiv = document.getElementById('imagePreview');

            // Lấy danh sách các tệp đã chọn
            var files = input.files;

            var customInput = document.getElementById('customFileInput');
            if ($('#imagePath').val() == '') {
                $('#imagePreview').empty();
            }

            // Hiển thị ảnh trước khi upload (có thể loại bỏ nếu không cần thiết)
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(files[i]);

                // Thêm file vào danh sách
                selectedFiles.push(files[i]);
            }

            var formData = new FormData();

            formData.append('_token', `{{ csrf_token() }}`);

            for (var i = 0; i < selectedFiles.length; i++) {
                formData.append('image[]', selectedFiles[i]);
            }

            $.ajax({
                type: "POST",
                url: `{{ route('admin.product.upload-image') }}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(respone) {
                    var newValues = '';
                    for (let index = 0; index < respone.data.length; index++) {
                        newValues = newValues + respone.data[index].image_path + ',';
                    }
                    selectedFiles = [];
                    $('#imagePath').val($('#imagePath').val() + newValues);
                },
                error: function(respone) {

                },
            });
        }
    </script>

    <script>
        $(".nameChangeSlug").on("keyup", function() {
            var value = $(this).val();
            $("#title_seo").val(value);
            $("#description_seo").val(value);
            $("#keyword_seo").val(value);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formattedPriceInput = document.getElementById('formattedPrice');
            const priceInput = document.getElementById('price');
            const formattedPriceInput1 = document.getElementById('formattedPrice1');
            const priceOldInput = document.getElementById('old_price');

            function formatCurrency(value) {
                return value.replace(/\D/g, '')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }

            function updateFormattedPrice() {
                const formattedValue = formatCurrency(formattedPriceInput.value);
                formattedPriceInput.value = formattedValue;
                priceInput.value = formattedValue.replace(/,/g, '');
            }

            function updateFormattedPrice1() {
                const formattedValue = formatCurrency(formattedPriceInput1.value);
                formattedPriceInput1.value = formattedValue;
                priceOldInput.value = formattedValue.replace(/,/g, '');
            }

            formattedPriceInput.addEventListener('input', updateFormattedPrice);
            formattedPriceInput1.addEventListener('input', updateFormattedPrice1);

            // Initialize the formatted value on page load
            updateFormattedPrice();
            updateFormattedPrice1();
        });

        // var route_prefix =
        //     "http://127.0.0.1:8000/laravel-filemanager";
        // $('#avatar_path').filemanager('image', {
        //     prefix: route_prefix
        // });
    </script>
@endsection
