@extends('admin.layouts.main')

@section('title', 'List service')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Service',
            'key' => 'List service',
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

                        <div class="text-right">
                            @if (request()->parent_id)
                                <a href="{{ route('admin.service.index', ['parent_id' => 0]) }}"
                                    class="custom-btn yellow mx-2">Go back</a>
                            @endif
                            <a href="{{ route('admin.service.create', ['parent_id' => request()->parent_id ?? 0]) }}"
                                class="custom-btn create">Thêm mới</a>
                        </div>


                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                @if ($parent)
                                    <h4>{{ $parent->name }}</h4>
                                @endif
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Folder</th>
                                                <th>Service</th>
                                                <th>Order</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($services) && $services->count() > 0)
                                                @foreach ($services as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            @if ($item->children->count())
                                                                <i class="fas fa-folder"></i>
                                                            @else
                                                                <i class="fas fa-file-alt"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('admin.service.index', ['parent_id' => $item->id]) }}">
                                                                {{ $item->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="order-quantity"
                                                                class="form-control number-input change-order"
                                                                data-url="{{ route('admin.service.changeOrder', ['id' => $item->id]) }}"
                                                                data-method="PATCH" placeholder="0"
                                                                value="{{ $item->order }}" min="0">
                                                        </td>
                                                        <td>
                                                            <button
                                                                data-url="{{ route('admin.service.changeActive', ['id' => $item->id]) }}"
                                                                data-method="PATCH"
                                                                class="btn btn-danger change-active {{ $item->active ? 'active' : '' }}">{{ $item->active ? 'Active' : 'Hide' }}</button>
                                                        </td>
                                                        <td>
                                                            @if (request()->parent_id)
                                                                <a href="{{ route('admin.service-option.index', ['service_id' => $item->id]) }}"
                                                                    class="btn btn-sm btn-success">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            @endif
                                                            <a href="{{ route('admin.service.edit', ['service' => $item->id, 'parent_id' => request()->parent_id ?? 0]) }}"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button
                                                                data-url="{{ route('admin.service.destroy', ['service' => $item->id]) }}"
                                                                class="btn btn-sm btn-danger delete-record"
                                                                data-method="DELETE">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center p-3">No data</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    {{ $services->links() }}
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
