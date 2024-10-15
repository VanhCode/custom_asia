@extends('admin.layouts.main')

@section('title', 'List service class')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', [
            'name' => 'Service class',
            'key' => 'List service class',
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
                            <a href="{{ route('admin.service-class.create') }}" class="custom-btn create">Thêm mới</a>
                        </div>


                        <div class="card card-outline card-primary mt-3">
                            <div class="card-body table-responsive lb-list-category">
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Service class</th>
                                                <th>Order</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($serviceClasses) && $serviceClasses->count() > 0)
                                                @foreach ($serviceClasses as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            <input type="number" id="order-quantity"
                                                                class="form-control number-input change-order"
                                                                data-url="{{ route('admin.service-class.changeOrder', ['id' => $item->id]) }}"
                                                                data-method="PATCH" placeholder="0"
                                                                value="{{ $item->order }}" min="0">
                                                        </td>
                                                        <td>
                                                            <button
                                                                data-url="{{ route('admin.service-class.changeActive', ['id' => $item->id]) }}"
                                                                data-method="PATCH"
                                                                class="btn btn-danger change-active {{ $item->active ? 'active' : '' }}">{{ $item->active ? 'Active' : 'Hide' }}</button>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.service-class.edit', ['service_class' => $item->id]) }}"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button
                                                                data-url="{{ route('admin.service-class.destroy', ['service_class' => $item->id]) }}"
                                                                class="btn btn-sm btn-danger delete-record"
                                                                data-method="DELETE">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center p-3">No data</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    {{ $serviceClasses->links() }}
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
