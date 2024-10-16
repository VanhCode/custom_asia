@extends('admin.layouts.main')
@section('title', 'Sửa tài khoản')
@section('css')
<link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
    }

    .select2-container .select2-selection--single {
        height: auto;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Amin User', 'key' => 'Sửa tài khoản'])
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
                    <form action="{{ route('admin.user.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin tài khoản</h3>
                                    </div>
                                    <div class="card-body table-responsive p-3">
                                        <div class="form-group">
                                            <label for="">Tên tài khoản</label>
                                            <input type="text" class="form-control" id="" value="{{ $data->name }}" name="name" placeholder="Nhập tài khoản">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="wrap-load-image mb-3">
                                            <div class="form-group">
                                                <label for="">Ảnh đại diện</label>
                                                <input type="file" class="form-control-file img-load-input border" id="" name="avatar_path">
                                            </div>
                                            @error('avatar_path')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            @if ($data->avatar_path)
                                            <img class="img-load border p-1 w-100" src="{{ $data->avatar_path }}" alt="{{ $data->name }}" style="height: 200px;object-fit:cover; max-width: 260px;">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="">Tiêu đề SEO</label>
                                            <input type="text" class="form-control" id="" value="{{ $data->title_seo }}" name="title_seo" placeholder="Nhập tiêu đề SEO">
                                            @error('title_seo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mô tả SEO</label>
                                            <input type="text" class="form-control" id="" value="{{ $data->description_seo }}" name="description_seo" placeholder="Nhập mô tả SEO">
                                            @error('description_seo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Từ khóa SEO</label>
                                            <input type="text" class="form-control" id="" value="{{ $data->keyword_seo }}" name="keyword_seo" placeholder="Nhập từ khóa SEO">
                                            @error('keyword_seo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="" for="">Giới thiệu</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="" rows="3" placeholder="Nhập giới thiệu">{{ $data->description }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" id="" value="{{ $data->email }}" name="email" placeholder="Email">
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mật khẩu</label>
                                            <input type="password" class="form-control" id="" value="{{ old('password') }}" name="password" placeholder="Nhập mật khẩu">
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nhập lại mật khẩu</label>
                                            <input type="password" class="form-control" id="" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                            @error('password_confirmation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chọn vai trò</label>
                                            <select name="role_id[]" class="form-control select-2-init" id="" multiple>
                                                <option value=""></option>
                                                @foreach ($dataRoles as $roleItem)
                                                <option {{ $dataRolesOfUser->get()->contains($roleItem->id) ? 'selected' : '' }} value="{{ $roleItem->id }}">
                                                    {{ $roleItem->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="1" name="active" @if ($data->active == '1' || old('active') == '1') {{ 'checked' }} @endif>Hiện
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="0" @if ($data->active == '0' || old('active') == '0') {{ 'checked' }} @endif
                                                    name="active">Ẩn
                                                </label>
                                            </div>
                                        </div>
                                        @error('active')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="checkrobot" id="checkrobot">
                                            <label class="form-check-label" for="checkrobot" required>Tôi đồng
                                                ý</label>
                                        </div>
                                        @error('checkrobot')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Chấp nhận</button>
                                            <button type="reset" class="btn btn-danger">Làm lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    $(function() {
        $(".select-2-init").select2({
            placeholder: "Chọn vai trò",
            allowClear: true
        })
    })
</script>
@endsection