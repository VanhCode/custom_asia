@extends('admin.layouts.main')
@section('title', 'Thêm bài viết')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name' => 'Bài viết', 'key' => 'Thêm bài viết'])
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
                        <form class="form-horizontal" action="{{ route('admin.post.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-primary">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-header">
                                                    @foreach ($errors->all() as $message)
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin bài viết</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng
                                                        quan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#topic">Chủ đề</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#destination">Điểm đến</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#seo">Seo</a>
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
                                                                            for="">Tên bài viết</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text"
                                                                                class="form-control nameChangeSlug
                                                                    @error('name_' . $langItem['value']) is-invalid @enderror"
                                                                                id="name_{{ $langItem['value'] }}"
                                                                                value="{{ old('name_' . $langItem['value']) }}"
                                                                                name="name_{{ $langItem['value'] }}"
                                                                                placeholder="Nhập tên tin tức">
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

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 control-label"
                                                                            for="">Nhập giới thiệu</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control  @error('description_' . $langItem['value']) is-invalid @enderror"
                                                                                name="description_{{ $langItem['value'] }}" id="" rows="3" placeholder="Nhập giới thiệu">{{ old('description_' . $langItem['value']) }}</textarea>
                                                                            @error('description_' . $langItem['value'])
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
                                                                            for="">Nhập nội dung</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control tinymce_editor_init @error('content_' . $langItem['value']) is-invalid  @enderror"
                                                                                name="content_{{ $langItem['value'] }}" id="editer" rows="20" value="" placeholder="Nhập nội dung">
                                                                    {{ old('content_' . $langItem['value']) }}
                                                                    </textarea>
                                                                            @error('content_' . $langItem['value'])
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
                                                    <div class="form-group">
                                                        {{-- <label class="col-sm-2 control-label" for="">Chọn danh mục</label>
                                                        <div class="col-sm-10">
                                                            <select
                                                                class="form-control custom-select select-2-init @error('category_id')
                                                                is-invalid
                                                                @enderror"
                                                                id="" value="{{ old('category_id') }}"
                                                                name="category_id">

                                                                <option value="0">--- Chọn danh mục cha ---
                                                                </option>

                                                                @if (old('category_id'))
                                                                    {!! \App\Models\CategoryPost::getHtmlOption(old('category_id')) !!}
                                                                @else
                                                                    {!! $option !!}
                                                                @endif
                                                            </select>
                                                            @error('category_id')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div> --}}
                                                        {{-- <div style="border: 1px solid; padding: 5px;"> --}}
                                                        <div class="row">
                                                            <label class="col-md-2 control-label" for="">Lựa chọn
                                                                chuyên mục</label>
                                                            <div class="col-md-10">
                                                                <div
                                                                    style="height: 250px; overflow: auto;border: 1px solid #eee;font-size: 12px;line-height: 18px;">
                                                                    @foreach ($data as $item)
                                                                        <div class="item-permission mt-2 mb-2">
                                                                            <div class="form-check permission-title"
                                                                                style="background: none">
                                                                                <label class="form-check-label p-2">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input check-parent"
                                                                                        value="{{ $item->id }}"
                                                                                        name="category[]">
                                                                                    {{ $item->name }}
                                                                                </label>
                                                                            </div>
                                                                            @if (count($item->childs) > 0)
                                                                                <div class="list-permission p-2 pl-4">
                                                                                    <div class="row">
                                                                                        @foreach ($item->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild)
                                                                                            <div
                                                                                                class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="form-check">
                                                                                                    <label
                                                                                                        class="form-check-label">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="form-check-input"
                                                                                                            name="category[]"
                                                                                                            value="{{ $itemChild->id }}">{{ $itemChild->name }}
                                                                                                    </label>
                                                                                                </div>
                                                                                                @if (count($itemChild->childs) > 0)
                                                                                                    <div class="row">
                                                                                                        @foreach ($itemChild->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild2)
                                                                                                            <div
                                                                                                                class="col-lg-12 col-md-12 col-sm-12">
                                                                                                                <div
                                                                                                                    class="form-check pl-5">
                                                                                                                    <label
                                                                                                                        class="form-check-label">
                                                                                                                        <input
                                                                                                                            type="checkbox"
                                                                                                                            class="form-check-input"
                                                                                                                            name="category[]"
                                                                                                                            value="{{ $itemChild2->id }}">{{ $itemChild2->name }}
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
                                                                                                                                            class="form-check-input"
                                                                                                                                            name="category[]"
                                                                                                                                            value="{{ $itemChild3->id }}">{{ $itemChild3->name }}
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
                                                        {{-- </div> --}}
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Số thứ
                                                                tự</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0"
                                                                    class="form-control  @error('order') is-invalid  @enderror"
                                                                    value="{{ old('order') }}" name="order"
                                                                    placeholder="Nhập số thứ tự">
                                                            </div>
                                                            @error('order')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Tin nổi
                                                                bật</label>
                                                            <div class="col-sm-10">
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
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Trạng
                                                                thái</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            value="1" name="active"
                                                                            @if (old('active') === '1' || old('active') === null) {{ 'checked' }} @endif>Hiện
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            value="0"
                                                                            @if (old('active') === '0') {{ 'checked' }} @endif
                                                                            name="active">Ẩn
                                                                    </label>
                                                                </div>
                                                                @error('active')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Tổng Quan -->

                                                <!-- START Hình Ảnh -->
                                                <div id="hinh_anh" class="container tab-pane fade"><br>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh đại diện</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <a id="avatar_path_id" data-input="avatar_path"
                                                                        data-preview="avatar_path_pr"
                                                                        class="btn btn-primary btn-file-manager">
                                                                        <i class="fa fa-picture-o"></i> Choose
                                                                    </a>
                                                                </span>
                                                                <input id="avatar_path"
                                                                    class="form-control input-file-change" type="text"
                                                                    name="avatar_path">
                                                            </div>
                                                        </div>
                                                        <div class="avatar_path-preview">
                                                            <img class="img-load border p-1 w-100"
                                                                src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                                style="height: 200px;object-fit:cover; max-width: 260px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Hình Ảnh -->

                                                <div id="topic" class="container tab-pane fade">
                                                    <div class="alert alert-light  mt-3 mb-1">
                                                        <strong>Lựa chọn chủ đề</strong>
                                                    </div>

                                                    @foreach ($topics as $item)
                                                        <div class="item-permission mt-2 mb-2">
                                                            <div class="list-permission p-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        class="form-check-input check-children "
                                                                        name="topic[]"
                                                                        value="{{ $item->id }}">{{ $item->name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div id="destination" class="container tab-pane fade">
                                                    <div class="alert alert-light  mt-3 mb-1">
                                                        <strong>Lựa chọn điểm đến</strong>
                                                    </div>

                                                    @foreach ($destinations as $item)
                                                        <div class="item-permission mt-2 mb-2">
                                                            <div class="form-check permission-title">
                                                                <label class="form-check-label p-3">
                                                                    <input type="checkbox"
                                                                        class="form-check-input check-parent"
                                                                        value="{{ $item->id }}"
                                                                        name="destination[]">{{ $item->name }}
                                                                </label>
                                                            </div>
                                                            @if (count($item->childs) > 0)
                                                                <div class="list-permission p-3 pl-4">
                                                                    @foreach ($item->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild)
                                                                        <div class="form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input check-children "
                                                                                name="destination[]"
                                                                                value="{{ $itemChild->id }}">{{ $itemChild->name }}
                                                                        </div>
                                                                        @if (count($itemChild->childs) > 0)
                                                                            <div class="row">
                                                                                @foreach ($itemChild->childs()->with('translationsLanguage')->where('active', 1)->orderBy('order')->get() as $itemChild2)
                                                                                    <div
                                                                                        class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="form-check pl-5">
                                                                                            <label
                                                                                                class="form-check-label">
                                                                                                <input type="checkbox"
                                                                                                    class="form-check-input check-children-c2"
                                                                                                    name="destination[]"
                                                                                                    value="{{ $itemChild2->id }}">{{ $itemChild2->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
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
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-tool p-3 text-right">
                                                    <button type="submit" class="btn btn-primary btn-lg">Chấp
                                                        nhận</button>
                                                    <button type="submit" class="btn btn-warning btn-lg save-draft">Lưu
                                                        nháp</button>
                                                    <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
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
        $(document).ready(function() {
            // Khi checkbox check-parent được nhấn
            $('.check-parent').on('change', function() {
                var isChecked = $(this).is(':checked');
                // Tìm và thay đổi trạng thái của các checkbox con bên dưới
                $(this).closest('.item-permission').find('.check-children, .check-children-c2').prop(
                    'checked', isChecked);
            });

            // Khi checkbox check-children-c2 được nhấn
            $('.check-children-c2').on('change', function() {
                var isChecked = $(this).is(':checked');
                // Tìm checkbox check-children tương ứng và check nó
                if (isChecked) {
                    $(this).closest('.form-check').find('.check-children').prop('checked', true);
                    // Tìm checkbox check-parent tương ứng và check nó
                    $(this).closest('.item-permission').find('.check-parent').prop('checked', true);
                }
            });

            // Khi checkbox check-children được nhấn
            $('.check-children').on('change', function() {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    // Nếu checkbox con được check, thì check luôn checkbox cha
                    $(this).closest('.item-permission').find('.check-parent').prop('checked', true);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var saveDraftBtn = document.querySelector('.save-draft');

            saveDraftBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của nút "Lưu nháp"

                var draftInput = document.createElement('input');
                draftInput.type = 'hidden';
                draftInput.name = 'status';
                draftInput.value = '2';

                var form = document.querySelector('.form-horizontal');
                form.appendChild(draftInput);

                form.submit(); // Gửi form đi sau khi đã thêm input ẩn
            });
        });
    </script>
    <script>
        $(".nameChangeSlug").on("keyup", function() {
            var value = $(this).val();
            $("#title_seo").val(value);
            $("#description_seo").val(value);
            $("#keyword_seo").val(value);
        });
    </script>
@endsection
