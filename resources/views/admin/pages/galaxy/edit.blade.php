@extends('admin.layouts.main')
@section('title', 'Sửa bài viêt')


@section('css')
@endsection
@section('content')
    <div class="content-wrapper lb_template_post_edit">
        @include('admin.partials.content-header', ['name' => 'Galaxy', 'key' => 'Sửa Galaxy'])

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
                        <form class="form-horizontal" action="{{ route('admin.galaxy.update', ['id' => $data->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
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
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin Galaxy</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng
                                                        quan</a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                   <a class="nav-link" data-toggle="tab" href="#du_lieu">Dữ liệu</a>
                                                 </li> -->
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#seo">Seo</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <!-- START Tổng Quan -->
                                                <div id="tong_quan" class="container tab-pane active"><br>
                                                    {{-- <ul class="nav nav-tabs">
                                                     @foreach ($langConfig as $langItem)
                                                     <li class="nav-item">
                                                         <a class="nav-link {{$langItem['value']==$langDefault?'active':''}}" data-toggle="tab" href="#tong_quan_{{$langItem['value']}}">{{ $langItem['name'] }}</a>
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
                                                                            for="">Tên dịch vụ</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control nameChangeSlug
                                                                     @error('name_' . $langItem['value']) is-invalid @enderror"
                                                                                id="name_{{ $langItem['value'] }}"
                                                                                value="{{ old('name_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->name }}"
                                                                                name="name_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập tên sản phẩm">
                                                                            @error('name_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
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
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập col</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control @error('col_' . $langItem['value']) is-invalid @enderror"
                                                                                id="col"
                                                                                value="{{ old('col_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->col }}"
                                                                                name="col_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập col ">
                                                                            @error('col_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập giới thiệu</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control  @error('description_' . $langItem['value']) is-invalid @enderror"
                                                                                name="description_{{ $langItem['value'] }}" id="" rows="3" placeholder="Nhập giới thiệu">{{ old('description_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->description }}</textarea>
                                                                            @error('description_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập nội dung</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control tinymce_editor_init @error('content_' . $langItem['value']) is-invalid  @enderror"
                                                                                name="content_{{ $langItem['value'] }}" id="editer" rows="20" value=""
                                                                                placeholder="Nhập nội dung">
                                                                     {{ old('content_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->content }}
                                                                     </textarea>
                                                                            @error('content_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                {{-- <div class="form-group form-check">
                                                             <div class="row">
                                                                 <label class="col-sm-2 control-label">

                                                                 </label>
                                                                 <div class="col-sm-10">
                                                                     <input type="checkbox" class="form-check-input" name="checkrobot" id="">
                                                                     <label class="form-check-label" for="" required>Tôi đồng ý</label>
                                                                 </div>
                                                             </div>
                                                             @error('checkrobot')
                                                             <div class="invalid-feedback d-block">{{ $message }}</div>
                                                             @enderror
                                                         </div> --}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- END Tổng Quan -->
                                                <!-- START Dữ Liệu -->
                                                <!-- <div id="du_lieu" class="container tab-pane fade"><br>
                                                 </div> -->
                                                <!-- END Dữ Liệu -->
                                                <!-- START Hình Ảnh -->
                                                <div id="hinh_anh" class="container tab-pane fade"><br>

                                                    <div class="wrap-load-image mb-3">
                                                        @php
                                                            $randomId = random_int(1, 999999);
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="">Ảnh đại diện</label>
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
                                                                    name="avatar_path"
                                                                    value="{{ $data->avatar_path ?? '' }}">
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

                                                    {{-- <div class="wrap-load-image mb-3">
                                                    <label class="mb-3 w-100">Hình ảnh khác</label>

                                                    <span class="badge badge-success">Đã thêm</span>
                                                    <div class="list-image d-flex flex-wrap">
                                                        @foreach ($data->images()->get() as $reviewImageItem)
                                                             <div class="col-image" style="width:20%;" >
                                                                <img class="" src="{{$reviewImageItem->image_path}}" alt="{{$reviewImageItem->name}}">
                                                                <a class="btn btn-sm btn-danger lb_delete_image"  data-url="{{ route('admin.galaxy.destroy-image',['id'=>$reviewImageItem->id]) }}"><i class="far fa-trash-alt"></i></a>
                                                             </div>
                                                         @endforeach
                                                         @if (!$data->images()->get()->count())
                                                            Chưa thêm hình ảnh nào
                                                         @endif
                                                    </div>
                                                    <hr>
                                                    <span class="badge badge-primary mb-3">Thêm ảnh</span>
                                                    <div class="form-group">
                                                        <label for="">Thêm ảnh</label>
                                                        <input type="file" class="form-control-file img-load-input-multiple border" id="" name="image[]" multiple>
                                                    </div>
                                                    @error('image')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    <div class="load-multiple-img">
                                                        @if (!$data->images()->get()->count())
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        @endif
                                                    </div>
                                                </div>

                                                 <hr> --}}

                                                </div>
                                                <!-- END Hình Ảnh -->

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
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập mô tả seo</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control @error('description_seo_' . $langItem['value']) is-invalid @enderror"
                                                                                id="description_seo"
                                                                                value="{{ old('description_seo_' . $langItem['value']) ?? optional($data->translationsLanguage($langItem['value'])->first())->description_seo }}"
                                                                                name="description_seo_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập mô tả seo">
                                                                            @error('description_seo_' . $langItem['value'])
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
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
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- END Seo -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin Galaxy</h3>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <div class="form-group">
                                                <label class="control-label" for="">Chọn danh mục</label>
                                                <select
                                                    class="form-control custom-select select-2-init @error('category_id')
                                                is-invalid
                                                @enderror"
                                                    id="" value="{{ old('category_id') }}" name="category_id">

                                                    <option value="0">--- Chọn danh mục cha ---</option>

                                                    @if (old('category_id') || old('category_id') === '0')
                                                        {!! \App\Models\CategoryGalaxy::getHtmlOption(old('category_id')) !!}
                                                    @else
                                                        {!! $option !!}
                                                    @endif
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
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
                                                <label class=" control-label" for="">Trạng thái</label>
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
