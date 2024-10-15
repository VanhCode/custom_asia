@extends('admin.layouts.main')
@section('title', 'Sửa tour')

@section('css')
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

        .all-image img {
            width: 100%;
            object-fit: contain;
            height: 130px;
        }

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
        }
    </style>
@endsection
@section('content')
    <input type="hidden" name="product_id_hidden" value="{{ $data->id }}">

    <div class="content-wrapper lb_template_product_edit">
        @include('admin.partials.content-header', ['name' => 'tour', 'key' => 'Sửa tour'])

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

                        {{-- <div class="box-link">
                            <a href="{{ route('admin.product.tab', ['product_id' => $data->id]) }}"
                                class="btn btn-sm btn-success">Danh sách điểm đến</a>
                        </div> --}}

                        <form class="form-horizontal" action="{{ route('admin.product.update', ['id' => $data->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        @foreach ($errors->all() as $message)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="card-tool p-3 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                        <button type="submit" class="btn btn-warning btn-lg save-draft">Lưu
                                            nháp</button>
                                        <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                        <button type="button" class="btn btn-info btn-lg"
                                            onclick="window.location.href=localStorage.getItem('urlListProduct')">Quay
                                            lại</button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="btn btn-zezo btn-lg w-100 flex-1">

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-build btn-lg w-100"
                                        href="{{ route('admin.product.tab', ['product_id' => $data->id]) }}">
                                        Itinerary builder
                                    </a>
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
                                                <div id="tong_quan" class="container tab-pane active"><br>
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
                                                                                value="{{ old('name_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->name }}"
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
                                                                                value="{{ old('slug_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->slug }}"
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

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Giới thiệu</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control tinymce_editor_init @error('description_' . $langItem['value']) is-invalid @enderror"
                                                                                name="description_{{ $langItem['value'] }}" id="editer2" rows="10" placeholder="Nhập giới thiệu">{{ old('description_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->description }}</textarea>
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
                                                                                name="content_{{ $langItem['value'] }}" id="editer1" rows="10" placeholder="Nhập nội dung">{{ old('content_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->content }}</textarea>
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
                                                </div>

                                                {{-- <div id="hinh_anh" class="container tab-pane fade"><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="wrap-load-image mb-3">
                                                                <div class="form-group">
                                                                    <label for="">Ảnh đại diện</label>
                                                                    <input type="file"
                                                                        class="form-control-file img-load-input border"
                                                                        id="" name="avatar_path">
                                                                </div>
                                                                @error('avatar_path')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                @if ($data->avatar_path)
                                                                    <div class="box-avatar">
                                                                        <img class="img-load border p-1 w-100"
                                                                            src="{{ $data->avatar_path }}"
                                                                            alt="{{ $data->name }}"
                                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                                        <a class="btn btn-sm btn-danger lb_delete_avatar"
                                                                            data-url="{{ route('admin.product.delete_avatar_path', ['id' => $data->id]) }}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="wrap-load-image mb-3">
                                                                <div class="form-group">
                                                                    <label for="">Ảnh bé</label>
                                                                    <input type="file"
                                                                        class="form-control-file img-load-input border"
                                                                        id="" name="file">
                                                                </div>
                                                                @error('file')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                @if ($data->file)
                                                                    <div class="box-avatar">
                                                                        <img class="img-load border p-1 w-100"
                                                                            src="{{ $data->file }}"
                                                                            alt="{{ $data->name }}"
                                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                                        <a class="btn btn-sm btn-danger lb_delete_avatar"
                                                                            data-url="{{ route('admin.product.delete_file', ['id' => $data->id]) }}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="wrap-load-image mb-3">
                                                                <div class="form-group">
                                                                    <label for="">Ảnh to</label>
                                                                    <input type="file"
                                                                        class="form-control-file img-load-input border"
                                                                        id="" name="file2">
                                                                </div>
                                                                @error('file2')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                @if ($data->file2)
                                                                    <div class="box-avatar">
                                                                        <img class="img-load border p-1 w-100"
                                                                            src="{{ $data->file2 }}"
                                                                            alt="{{ $data->name }}"
                                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                                        <a class="btn btn-sm btn-danger lb_delete_avatar"
                                                                            data-url="{{ route('admin.product.delete_file2', ['id' => $data->id]) }}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wrap-load-image mb-3">
                                                        <hr>
                                                        <span class="badge badge-primary mb-3">Thêm ảnh liên quan</span>
                                                        <div class="form-group">
                                                            <input type="file"
                                                                class="form-control-file img-load-input-multiple border"
                                                                id="" name="image[]" multiple>
                                                        </div>
                                                        @error('image')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror

                                                        <ul class="image-list-small">
                                                            @foreach ($data->images()->get() as $productImageItem)
                                                                @php
                                                                    $url = asset('');
                                                                @endphp

                                                                <li style="position: relative">
                                                                    <a href="javascript:;"
                                                                        style="background-image: url({{ $url }}{{ $productImageItem->image_path }});"></a>
                                                                    <input type="hidden" name="file_xx[]"
                                                                        value="{{ $productImageItem->image_path }}">
                                                                    <a style="position:absolute; top:0; right:0; width:25px; height:27px;"
                                                                        class="btn btn-sm btn-danger lb_delete_image_new"
                                                                        data-id="{{ $productImageItem->id }}"
                                                                        data-url="{{ route('admin.product.destroy-image', ['id' => $productImageItem->id]) }}">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                                <!-- END Hình Ảnh -->

                                                <div id="thuoctinh" class="container tab-pane fade">
                                                    <div class="alert alert-light  mt-3 mb-1">
                                                        <strong>Lựa chọn thuộc tính</strong>
                                                    </div>
                                                    @foreach ($attributes as $key => $attribute)
                                                        <div class="item-permission mt-2 mb-2">
                                                            <div class="form-check permission-title">
                                                                <label class="form-check-label p-3"
                                                                    for="">{{ $attribute->name }}</label>
                                                            </div>
                                                            <div class="list-permission p-3 pl-4">
                                                                @foreach ($attribute->childs()->orderby('order')->get() as $k => $attr)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="attribute[{{ $key }}][]"
                                                                            value="{{ $attr->id }}"
                                                                            @if (old('attribute')) @if (in_array($attr->id, old('attribute')[$key])) checked @endif
                                                                        @else
                                                                            @if ($data->attributes()->get()->pluck('id')->contains($attr->id)) checked @endif
                                                                            @endif
                                                                        @if ($categoryAttrOfAdmin->contains($attr->id)) {{ 'checked' }} @endif
                                                                        >
                                                                        <label class="form-check-label"
                                                                            for="{{ $attribute->name }}_{{ $attr->id }}">
                                                                            {{ $attr->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @error('attribute.' . $key)
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    @endforeach
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
                                                                                value="{{ old('title_seo_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->title_seo }}"
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
                                                                            <textarea class="form-control @error('description_seo_' . $langItem['value']) is-invalid @enderror"
                                                                                id="description_seo" name="description_seo_{{ $langItem['value'] }}" placeholder="Nhập mô tả seo"
                                                                                rows="3">{{ old('description_seo_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->description_seo }}</textarea>

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
                                                                                value="{{ old('keyword_seo_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->keyword_seo }}"
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
                                                                                @else
                                                                                    @foreach ($data->tagsLanguage($langItem['value'])->get() as $tagItem)
                                                                                        <option
                                                                                            value="{{ $tagItem->name }}"
                                                                                            selected>{{ $tagItem->name }}
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

                                                <!-- START Category -->
                                                <div id="category" class="container tab-pane fade">
                                                    <div class="form-group">
                                                        <div style="border: 1px solid; padding: 5px;">
                                                            <label class="control-label" for="">Lựa chọn chuyên
                                                                mục</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div
                                                                        style="height: 250px; overflow: auto;border: 1px solid #eee;font-size: 12px;line-height: 18px;">
                                                                        @foreach ($data_ed as $item)
                                                                            <div class="item-permission mt-2 mb-2">
                                                                                <div class="form-check permission-title">
                                                                                    <label class="form-check-label p-2">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input check-children"
                                                                                            value="{{ $item->id }}"
                                                                                            name="category[]"
                                                                                            @if ($categoryProductOfAdmin->contains($item->id)) {{ 'checked' }} @endif>{{ $item->name }}
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
                                                                                                                value="{{ $itemChild->id }}"
                                                                                                                @if ($categoryProductOfAdmin->contains($itemChild->id)) {{ 'checked' }} @endif>{{ $itemChild->name }}
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
                                                                                                                                value="{{ $itemChild2->id }}"
                                                                                                                                @if ($categoryProductOfAdmin->contains($itemChild2->id)) {{ 'checked' }} @endif>{{ $itemChild2->name }}
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                    @if (count($itemChild2->childs) > 0)
                                                                                                                        <div
                                                                                                                            class="row">
                                                                                                                            @foreach ($itemChild2->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild3)
                                                                                                                                <div
                                                                                                                                    class="col-lg-12 col-md-12 col-sm-12">
                                                                                                                                    <div class="form-check pl-5"
                                                                                                                                        style="padding-left: 4rem!important;">
                                                                                                                                        <label
                                                                                                                                            class="form-check-label">
                                                                                                                                            <input
                                                                                                                                                type="checkbox"
                                                                                                                                                class="form-check-input check-children"
                                                                                                                                                name="category[]"
                                                                                                                                                value="{{ $itemChild3->id }}"
                                                                                                                                                @if ($categoryProductOfAdmin->contains($itemChild3->id)) {{ 'checked' }} @endif>{{ $itemChild3->name }}
                                                                                                                                        </label>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            @endforeach
                                                                                                                        </div>
                                                                                                                    @endif
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
                                                <!-- END Category -->
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
                                                <label class="control-label" for="">Nhập mã tour</label>
                                                <input type="text" min="0"
                                                    class="form-control  @error('masp') is-invalid  @enderror"
                                                    value="{{ old('masp') ?? $data->masp }}" name="masp"
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
                                                    value="{{ old('content2_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->content2 }}"
                                                    name="content2_{{ $langItem['value'] }}"
                                                    placeholder="Nhập loại tour">
                                                @error('content2')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Thời gian (days)</label>
                                                <input type="number" min="0"
                                                    class="form-control  @error('number') is-invalid  @enderror"
                                                    value="{{ old('number') ?? $data->number }}" name="number"
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
                                                            class="form-check-input @error('hot') is-invalid
                                                        @enderror"
                                                            value="1" name="hot"
                                                            @if (old('hot') === '1' || $data->hot == 1) {{ 'checked' }} @endif>
                                                    </label>
                                                </div>
                                                @error('hot')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Trạng thái</label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="1"
                                                            name="active"
                                                            @if (old('active') === '1' || $data->active == 1) {{ 'checked' }} @endif>Hiện
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="0"
                                                            @if (old('active') === '0' || $data->active == 0) {{ 'checked' }} @endif
                                                            name="active">Ẩn
                                                    </label>
                                                </div>
                                                @error('active')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Giá mới</label>
                                                <input type="text" id="formattedPrice"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price') ?? $data->price }}" placeholder="Nhập giá">
                                                <input type="hidden" name="price" id="price"
                                                    value="{{ old('price') ?? $data->price }}">
                                                @error('price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Giá cũ</label>
                                                <input type="text" id="formattedPrice1"
                                                    class="form-control @error('old_price') is-invalid @enderror"
                                                    value="{{ old('old_price') ?? $data->old_price }}"
                                                    placeholder="Nhập giá cũ">
                                                <input type="hidden" name="old_price" id="old_price"
                                                    value="{{ old('old_price') ?? $data->old_price }}">
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
                                            <div class="wrap-load-image mb-3">
                                                @php
                                                    $randomId = random_int(1, 999999);
                                                @endphp
                                                <div class="form-group">
                                                    <label for="">Thumbnail</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="avatar_path_{{ $randomId }}"
                                                                data-input="btn-remove-{{ $randomId }}"
                                                                data-preview="avatar_path_pr"
                                                                class="btn btn-primary btn-file-manager">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="btn-remove-{{ $randomId }}"
                                                            class="form-control input-file-change" type="text"
                                                            name="avatar_path" value="{{ $data->avatar_path ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="btn-remove-{{ $randomId }}-preview">
                                                    @if ($data->avatar_path)
                                                        <div class="form-group__img preview-avatar"
                                                            data-name="avatar_path" data-delete="">
                                                            <img src="{{ $data->avatar_path }}">
                                                            <div class="form-group__delete delete-avatar"
                                                                id="btn-remove-{{ $randomId }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path
                                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="wrap-load-image mb-3">
                                                @php
                                                    $randomId = random_int(1, 999999);
                                                @endphp
                                                <div class="form-group">
                                                    <label for="">Image map small</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="file_{{ $randomId }}"
                                                                data-input="btn-remove-{{ $randomId }}"
                                                                data-preview="file_pr"
                                                                class="btn btn-primary btn-file-manager">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="btn-remove-{{ $randomId }}"
                                                            class="form-control input-file-change" type="text"
                                                            name="file" value="{{ $data->file ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="btn-remove-{{ $randomId }}-preview">
                                                    @if ($data->file)
                                                        <div class="form-group__img preview-avatar" data-name="file"
                                                            data-delete="">
                                                            <img src="{{ $data->file }}">
                                                            <div class="form-group__delete delete-avatar"
                                                                id="btn-remove-{{ $randomId }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path
                                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="wrap-load-image mb-3">
                                                @php
                                                    $randomId = random_int(1, 999999);
                                                @endphp
                                                <div class="form-group">
                                                    <label for="">Image map large</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="file2_{{ $randomId }}"
                                                                data-input="btn-remove-{{ $randomId }}"
                                                                data-preview="file2_pr"
                                                                class="btn btn-primary btn-file-manager">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="btn-remove-{{ $randomId }}"
                                                            class="form-control input-file-change" type="text"
                                                            name="file2" value="{{ $data->file2 ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="btn-remove-{{ $randomId }}-preview">
                                                    @if ($data->file2)
                                                        <div class="form-group__img preview-avatar" data-name="file2"
                                                            data-delete="">
                                                            <img src="{{ $data->file2 }}">
                                                            <div class="form-group__delete delete-avatar"
                                                                id="btn-remove-{{ $randomId }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path
                                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img class="img-load border p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    @endif

                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Thumbnail</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="avatar_path">
                                                @error('avatar_path')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="avatar_path">
                                                    <img src="{{ $data->avatar_path ?? asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <input type="hidden" class="images_old-item" data-name="avatar_path"
                                                        name="avatar_path_old" value="{{ $data->avatar_path }}">
                                                    <div
                                                        class="form-group__delete delete-avatar {{ !$data->avatar_path ? 'd-none' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Mini map image</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="file">
                                                @error('file')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="file">
                                                    <img src="{{ $data->file ?? asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <input type="hidden" class="images_old-item" data-name="file"
                                                        name="file_old" value="{{ $data->file }}">
                                                    <div
                                                        class="form-group__delete delete-avatar {{ !$data->file ? 'd-none' : '' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Large map image</label>
                                                <input type="file" min="0" class="form-control load-avatar"
                                                    value="" name="file2">
                                                @error('file2')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group__img preview-avatar" data-name="file2">
                                                    <img src="{{ $data->file2 ?? asset('admin_asset/images/upload-image.png') }}"
                                                        alt="">
                                                    <div
                                                        class="form-group__delete delete-avatar {{ !$data->file2 ? 'd-none' : '' }}">
                                                        <input type="hidden" class="images_old-item" data-name="file2"
                                                            name="file2_old" value="{{ $data->file2 }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div> --}}



                                            {{-- <div class="form-group">
                                                <label class="control-label" for="">Gallery</label>
                                                <input type="file" min="0"
                                                    class="form-control load-gallery-image " value="df"
                                                    name="image[]" multiple>
                                                @if (count($data->images) > 0)
                                                    @foreach ($data->images as $index => $image)
                                                        <input type="hidden" class="images_old-gallery"
                                                            id="data-index-{{ $index }}" name="images_old[]"
                                                            value="{{ $image->image_path }}">
                                                    @endforeach
                                                @endif
                                                <div class="form-group__gallery row">
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
                                                                type="text" name="gallary"
                                                                value="{{ $data->images()->count() ? implode(',', $data->images()->pluck('image_path')->toArray()) : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="gallary-mutiple-preview row">
                                                        @if ($data->images()->count())
                                                            @foreach ($data->images()->get() as $item)
                                                                <div class="col-6 form-group__img preview-avatar"
                                                                    data-name="avatar_path">
                                                                    <img src="{{ $item->image_path }}">
                                                                    <div class="form-group__delete delete-avatar-galary"
                                                                        id="btn-remove-${randomId}"
                                                                        data-link="{{ $item->image_path }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                            <path
                                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="row">
                            <input type="hidden" id="tour_id" value="{{ $data->id }}">
                            <input type="hidden" id="url_save" value="{{ route('admin.product.saveMap') }}">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Bản đồ</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-sm btn-success" id="save_map">Lưu bản đồ</button>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" id="dataResult"
                                                        value="{{ json_encode($results) }}" />
                                                    <span class="form-input-search">
                                                        <span class="icon-input-search">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                        <input type="text" id="search"
                                                            placeholder="Chọn địa điểm ..." class="form-control">
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="border br-3">
                                                        <ul class="list-destination" id="list-address">
                                                            @if (isset($dataMaps))
                                                                @foreach ($dataMaps as $dataMap)
                                                                    @if ($loop->first)
                                                                        <li data-lat="{{ $dataMap->latitude }}"
                                                                            data-long="{{ $dataMap->longitude }}">
                                                                            <div class="info-location">
                                                                                <div class="d-flex align-items-center">
                                                                                    <img class="mr-8 move-destination"
                                                                                        src="{{ asset('/admin_asset/images/three-dot.svg') }}">
                                                                                    <img class="mark-point"
                                                                                        src="{{ asset('/admin_asset/images/start-image.svg') }}">
                                                                                    <span class="ml-8">
                                                                                        {{ $dataMap->name }}
                                                                                    </span>
                                                                                </div>
                                                                                <div class="trash-destination">
                                                                                    <img
                                                                                        src="{{ asset('/admin_asset/images/trash-image.svg') }}">
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @elseif ($loop->last)
                                                                        <li data-lat="{{ $dataMap->latitude }}"
                                                                            data-long="{{ $dataMap->longitude }}">
                                                                            <div class="info-location">
                                                                                <div class="d-flex align-items-center">
                                                                                    <img class="mr-8 move-destination"
                                                                                        src="{{ asset('/admin_asset/images/three-dot.svg') }}">
                                                                                    <img class="mark-point"
                                                                                        src="{{ asset('/admin_asset/images/end-image.svg') }}">
                                                                                    <span class="ml-8">
                                                                                        {{ $dataMap->name }}
                                                                                    </span>
                                                                                </div>
                                                                                <div class="trash-destination">
                                                                                    <img
                                                                                        src="{{ asset('/admin_asset/images/trash-image.svg') }}">
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @else
                                                                        <li data-lat="{{ $dataMap->latitude }}"
                                                                            data-long="{{ $dataMap->longitude }}">
                                                                            <div class="info-location">
                                                                                <div class="d-flex align-items-center">
                                                                                    <img class="mr-8 move-destination"
                                                                                        src="{{ asset('/admin_asset/images/three-dot.svg') }}">
                                                                                    <img class="mark-point"
                                                                                        src="{{ asset('/admin_asset/images/mid-image.svg') }}">
                                                                                    <span class="ml-8">
                                                                                        {{ $dataMap->name }}
                                                                                    </span>
                                                                                </div>
                                                                                <div class="trash-destination">
                                                                                    <img
                                                                                        src="{{ asset('/admin_asset/images/trash-image.svg') }}">
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('/admin_asset/js/map.js') }}"></script>

    <script>
        $(function() {
            $(".image-list-small").sortable({
                change: function(event, ui) {
                    var form = $("#formNew");
                    form.find("input[name='index[]']").remove();

                    $(".image-list-small li").each(function(index, element) {
                        var inputValue = $(element).find("input[name='file_xx[]']").val();
                        if (inputValue && inputValue.trim() !== "") {
                            form.append('<input type="hidden" name="index[]" value="' +
                                inputValue + '">');
                        }
                    });
                },
            });
        });
    </script>
    <script>
        $(document).on('change', 'input[name="image[]"]', function(e) {
            var file = e.target.files;
            var product_id_hidden = $('input[name="product_id_hidden"]').val();
            var formData = new FormData();
            for (let i = 0; i < file.length; i++) {
                formData.append('image' + i, file[i]);
            }
            formData.append('id', product_id_hidden);
            formData.append("total", file.length);
            $.ajax({
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                url: '{{ route('admin.product.uploadFileNew') }}',
                cache: false,
                type: "POST",
                data: formData,
                processData: false, ///required to upload file
                contentType: false, /// required
                success: function(response) {
                    console.log(response);
                    var u = response.arrPath;
                    console.log(u.length);
                    var html = '';
                    for (let j = 0; j < u.length; j++) {
                        var assetUrl =
                            "{{ asset('') }}"; // Sử dụng Laravel Blade syntax để đặt URL cơ sở của tệp tĩnh
                        html += `
                    <li style="position: relative">
                        <a href="javascript:;" style="background-image: url(${assetUrl}storage/${u[j]});"></a>
                        <input type="hidden" name="file_xx[]" value="storage/` + u[j] + `">
                    </li>
                    `;
                    }
                    $('.image-list-small').append(html);
                },
            });
        });
        $(".lb_delete_image_new").click(function() {
            // Xóa phần tử li chứa nút đã được click
            var dataId = $(this).data('id');
            var hiddenInput = '<input type="hidden" name="deleted_image_ids[]" value="' + dataId + '">';
            $("form").append(hiddenInput);
            $(this).closest("li").remove();
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
    </script>

    <script>
        $(document).on('click', '.delete-avatar1', function(event) {
            event.preventDefault();
            let urlRequest = $(this).data("url");
            let mythis = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa ảnh này?',
                text: "Bạn sẽ không thể khôi phục điều này",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tôi đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        success: function(data) {
                            if (data.code == 200) {
                                mythis.parents(".preview-avatar")
                                    .remove(); // Xóa phần hiển thị ảnh
                                location.reload();
                            }
                        },
                        error: function() {
                            Swal.fire('Có lỗi xảy ra', 'Không thể xóa ảnh', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
