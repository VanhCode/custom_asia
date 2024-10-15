<form class="form-horizontal" action="{{ route('admin.product.tab.update', ['id' => $data->id]) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    {{-- <div class="row box-wrap-info-2">
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
    </div> --}}
    <div class="row table-scroll">

        <div class="col-md-12">
            <div class="card card-outline card-primary">
                {{-- <div class="card-header">
                    <h3 class="card-title">Thông tin Tab</h3>
                </div> --}}
                <div class="card-body table-responsive">
                    {{-- <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng
                                quan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                        </li>
                    </ul> --}}

                    <div class="tab-content">
                        <!-- START Tổng Quan -->
                        <div id="tong_quan" class="container tab-pane active">

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
                                                <div class="col-6">
                                                    <label class="col-sm-12 control-label" for="">Tên</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control 
                                            @error('name') is-invalid @enderror"
                                                            id="name" value="{{ old('name') ?? $data->name }}"
                                                            name="name" placeholder="Nhập tên">
                                                        @error('name')
                                                            <div class="invalid-feedback d-block">
                                                                {{ $message }}</div>
                                                        @enderror

                                                        <input type="hidden" class="form-control"
                                                            value="{{ $data->product_id }}" name="product_id">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="col-sm-12 control-label" for="">Giới
                                                        thiệu</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control 
                                            @error('description') is-invalid @enderror"
                                                            id="description"
                                                            value="{{ old('description') ?? $data->description }}"
                                                            name="description" placeholder="Nhập giới thiệu">
                                                        {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3"
                                                            placeholder="Nhập giới thiệu">{{ old('description') ?? $data->description }}</textarea> --}}
                                                        @error('description')
                                                            <div class="invalid-feedback d-block">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label"
                                                    for="">Icon</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control 
                                            @error('icon') is-invalid  @enderror"
                                                        value="{{ old('icon') ?? $data->icon }}"
                                                        name="icon" placeholder="Nhập icon">
                                                    @error('icon')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-12 control-label" for="">Giới thiệu</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3"
                                                        placeholder="Nhập giới thiệu">{{ old('description') ?? $data->description }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-12 control-label" for="">Thông tin chi
                                                    tiết</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control tinymce_editor_init @error('content') is-invalid  @enderror" name="content" id="content"
                                                        rows="20" value="" placeholder="Nhập mô tả">
                                                    {{ old('content') ?? $data->content }}
                                                    </textarea>
                                                    @error('content')
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
                        <!-- END Tổng Quan -->

                        <!-- START Hình Ảnh -->
                        <div id="hinh_anh" class="container tab-pane fade"><br>

                            <div class="wrap-load-image mb-3">
                                <div class="form-group">
                                    <label for="">Ảnh đại diện</label>
                                    <input type="file" class="form-control-file img-load-input border" id=""
                                        name="avatar_path">
                                </div>
                                @error('avatar_path')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if ($data->avatar_path)
                                    <img class="img-load border p-1 w-100" src="{{ $data->avatar_path }}"
                                        alt="{{ $data->name }}"
                                        style="height: 200px;object-fit:cover; max-width: 260px;">
                                @endif
                            </div>
                        </div>
                        <!-- END Hình Ảnh -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-btn-confirm">
        <button type="submit" class="btn btn-primary btn-lg btn-confirm">Chấp nhận</button>
    </div>
</form>
<script src="{{ asset('admin_asset/js/main.js') }}"></script>
