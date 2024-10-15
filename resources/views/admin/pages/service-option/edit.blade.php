@extends('admin.layouts.main')

@section('title', 'Create service option')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Service option',
            'key' => 'Create service option',
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
                                        action="{{ route('admin.service-option.update', ['service_option' => $serviceOption->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Service option:</label>
                                                <input type="text"
                                                    class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                    id="name" placeholder="Service option"
                                                    value="{{ old('name') ?? $serviceOption->name }}" name="name">
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price:</label>
                                                <input type="number"
                                                    class="form-control @if ($errors->has('price')) is-invalid @endif"
                                                    id="price" min="0" placeholder="price" name="price"
                                                    value="{{ old('price') ?? $serviceOption->price }}">
                                                @if ($errors->has('price'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('price') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="service_type_id">Service Type:</label>
                                                <select name="service_type_id" id="service_type_id"
                                                    class=" @if ($errors->has('service_type_id')) is-invalid @endif">
                                                    @foreach ($servicesType as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($loop->first) selected @endif
                                                            {{ old('service_type_id') ?? $serviceOption->service_type_id == $value->id ? 'selected' : '' }}>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('service_type_id'))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first('service_type_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type:</label>
                                                <input type="text"
                                                    class="form-control @if ($errors->has('type')) is-invalid @endif"
                                                    id="type" placeholder="Type"
                                                    value="{{ old('type') ?? $serviceOption->type }}" name="type">
                                                @if ($errors->has('type'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('type') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="control-label" for="description">Description</label>
                                            <textarea name="description" id="description" class="ckeditor">
                                                {{ old('description') ?? $serviceOption->description }}
                                            </textarea>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end col-12">
                                            <a href="{{ url()->previous() }}" class="custom-btn yellow mx-2">Go back</a>
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
