@extends('admin.layouts.main')
@section('title', 'Sửa điểm đến')

@section('content')

    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name' => 'điểm đến', 'key' => 'Sửa điểm đến'])
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
                        <form action="{{ route('admin.destination.update', ['id' => $data->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        @foreach ($errors->all() as $message)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-tool p-3 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                        <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin điểm đến</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
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
                                                        class="p-3 tab-pane {{ $langItem['value'] == $langDefault ? 'active show' : '' }} fade">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label"
                                                                    for="">Tên</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text"
                                                                        class="form-control nameChangeSlug
                                                        @error('name_' . $langItem['value']) is-invalid @enderror"
                                                                        id="name_{{ $langItem['value'] }}"
                                                                        value="{{ old('name_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->name }}"
                                                                        name="name_{{ $langItem['value'] }}"
                                                                        placeholder="Nhập tên">
                                                                    @error('name_' . $langItem['value'])
                                                                        <div class="invalid-feedback d-block">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label" for="">value</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control
                                                        @error('value_' . $langItem['value']) is-invalid  @enderror" id="value_{{ $langItem['value'] }}" value="{{ old('value_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->slug }}" name="value_{{ $langItem['value'] }}" placeholder="Nhập value">
                                                        @error('value_' . $langItem['value'])
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin khác</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <div class="form-group">
                                                <label class="control-label" for="">Chọn danh mục</label>
                                                <select
                                                    class="form-control custom-select select-2-init 
                                                    @error('parent_id')
                                            is-invalid
                                            @enderror"
                                                    id="" value="{{ old('parent_id') }}" name="parent_id">
                                                    <option value="0">--- Root---</option>
                                                    @if (old('parent_id') || old('parent_id') === '0')
                                                        {!! \App\Models\destination::getHtmlOptionAddWithParent(old('parent_id')) !!}
                                                    @else
                                                        {!! $option !!}
                                                    @endif
                                                </select>
                                                @error('parent_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="wrap-load-image mb-3">
                                                <div class="form-group">
                                                    <label for="">Hình ảnh</label>
                                                    <input type="file" class="form-control-file img-load-input border"
                                                        id="" value="" name="image">
                                                </div>
                                                @error('image')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @if ($data->image)
                                                    <div class="box-avatar">
                                                        <img class="img-load border p-1 w-100" src="{{ $data->image }}"
                                                            alt="{{ $data->name }}"
                                                            style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    </div>
                                                @endif
                                            </div> --}}

                                            <div class="wrap-load-image mb-3">
                                                @php
                                                    $randomId = random_int(1, 999999);
                                                @endphp
                                                <div class="form-group">
                                                    <label for="">Ảnh đại diện</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a id="image_{{ $randomId }}"
                                                                data-input="btn-remove-{{ $randomId }}"
                                                                data-preview="image_pr"
                                                                class="btn btn-primary btn-file-manager">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="btn-remove-{{ $randomId }}"
                                                            class="form-control input-file-change" type="text"
                                                            name="image" value="{{ $data->image ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="btn-remove-{{ $randomId }}-preview">
                                                    @if ($data->image)
                                                        <div class="form-group__img preview-avatar" data-name="image"
                                                            data-delete="">
                                                            <img src="{{ $data->image }}">
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

                                            <div class="form-group">
                                                <label class="control-label" for="">Số thứ tự</label>

                                                <input type="number" min="0"
                                                    class="form-control  @error('order') is-invalid  @enderror"
                                                    value="{{ old('order') ?? $data->order }}" name="order"
                                                    placeholder="Nhập số thứ tự">

                                                @error('order')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Trạng thái</label>

                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="1"
                                                            name="active"
                                                            @if (old('active') === '1' || old('active') === null) {{ 'checked' }} @endif>Hiện
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="0"
                                                            @if (old('active') === '0') {{ 'checked' }} @endif
                                                            name="active">Ẩn
                                                    </label>
                                                </div>
                                                @error('active')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
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

@endsection
