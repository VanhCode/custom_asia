@extends('admin.layouts.main')

@section('title', 'Update service type')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Service type',
            'key' => 'Update service type',
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

                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <div>
                                    <form class="row"
                                        action="{{ route('admin.service-type.update', ['service_type' => $serviceType->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Service type:</label>
                                                <input type="text"
                                                    class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                    id="name" placeholder="Service type"
                                                    value="{{ old('name') ?? $serviceType->name }}" name="name">
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="order">Order:</label>
                                                <input type="number"
                                                    class="form-control @if ($errors->has('order')) is-invalid @endif"
                                                    id="order" min="0" placeholder="Order" name="order"
                                                    value="{{ old('order') ?? $serviceType->order }}">
                                                @if ($errors->has('order'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('order') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pt-2">
                                                <label class="w-100">Status:</label>
                                                <div class="d-flex">
                                                    <div class="radio-group px-2">
                                                        <input type="radio" name="active" value="1"
                                                            id="status-active"
                                                            @if (old('active') === '1' || $serviceType->active == 1) {{ 'checked' }} @endif>
                                                        <label for="status-active">Active</label>
                                                    </div>
                                                    <div class="radio-group px-2">
                                                        <input type="radio" name="active" value="0" id="status-hide"
                                                            @if (old('active') === '0' || $serviceType->active == 0) {{ 'checked' }} @endif>
                                                        <label for="status-hide">Hide</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="control-label" for="description">Description</label>
                                            <textarea name="description" id="description" class="ckeditor">
                                                {{ old('description') ?? $serviceType->description }}
                                            </textarea>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end col-12">
                                            <button type="submit" class="custom-btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>

@endsection

@section('js')
    <script src="{{ asset('custom/js/main.js') }}"></script>
@endsection
