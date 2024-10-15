@extends('admin.layouts.main')

@section('title', 'List service option')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
    <style>
        .box-service-wrap {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            margin-bottom: 10px;
        }

        .box-service-option {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .box-service-option.title {
            padding: 5px;
            background-color: bisque
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">

        {{-- @include('admin.partials.content-header', [
            'name' => 'Service option',
            'key' => 'List service option',
        ]) --}}


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

                        <h3 class="mt-3">{{ $service->name }}</h3>

                        {{-- <div class="text-right">
                            <a href="{{ route('admin.service-other.create') }}" class="custom-btn create">Thêm mới</a>
                        </div> --}}

                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                @if ($service->seasons->count() > 0)
                                    @foreach ($service->seasons()->get() as $item)
                                        <div class="box-service-wrap">
                                            <div class="box-service-option title">
                                                <div>
                                                    {{ $item->name }}
                                                    ({{ \Carbon::parse($item->date_from)->format('d/m/Y') }} -
                                                    {{ \Carbon::parse($item->date_to)->format('d/m/Y') }})
                                                </div>
                                                <div class="d-flex">
                                                    <button class="btn btn-warning mx-2 trigger-modal-btn"
                                                        data-type="update" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->name }}"
                                                        data-date_from="{{ $item->date_from }}"
                                                        data-date_to="{{ $item->date_to }}"
                                                        data-url="{{ route('admin.service-season.update', ['service_season' => $item->id]) }}">Update</button>
                                                    <button class="btn btn-danger delete-record"
                                                        data-url="{{ route('admin.service-season.destroy', ['service_season' => $item->id]) }}"
                                                        data-method="DELETE">Delete</button>
                                                </div>
                                            </div>
                                            <div class="box-service-option content">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->services()->orderBy('created_at', 'desc')->get() as $index => $option)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $option->name }}</td>
                                                                <td>{{ number_format($option->price) }}</td>
                                                                <td>{{ $option->type }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.service-option.edit', ['service_option' => $option->id]) }}"
                                                                        class="btn btn-warning delete-record-option">Edit</a>
                                                                    <button
                                                                        data-url="{{ route('admin.service-option.destroy', ['service_option' => $option->id]) }}"
                                                                        data-method="DELETE"
                                                                        class="btn btn-danger delete-record">Delete</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="5" style="cursor: pointer">
                                                                <a
                                                                    href="{{ route('admin.service-option.create', ['service_id' => $service->id, 'service_season_id' => $item->id]) }}">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-data-message">
                                        No data available
                                    </div>
                                @endif

                            </div>
                            <div class="px-3">
                                <button class="trigger-modal-btn" data-type="create">Create
                                    Season</button>
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

    <!-- Modal -->
    <div class="custom-modal-overlay" id="custom-modal">
        <form id="customForm" action="{{ route('admin.service-season.store', ['service_id' => $service->id]) }}"
            method="POST" data-type="create">
            <div class="custom-modal">
                <div class="custom-modal-header">
                    <h2 class="custom-modal-title">Create Season</h2>
                    <span class="custom-close-btn">&times;</span>
                </div>
                <div class="custom-modal-body">
                    <div class="form-group">
                        <label for="name">Name Season:</label>
                        <input type="text" id="name" name="name" class="custom-input"
                            placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="date_from">Season Date From:</label>
                        <input type="date" id="date_from" name="date_from" class="custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="date_to">Season Date To:</label>
                        <input type="date" id="date_to" name="date_to" class="custom-input" required>
                    </div>

                </div>
                <div class="custom-modal-footer">
                    <button type="submit" class="custom-btn custom-btn-confirm">Xác nhận</button>
                    <button class="custom-btn custom-btn-cancel">Hủy</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script src="{{ asset('custom/js/main.js') }}"></script>
@endsection
