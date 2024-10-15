@extends('admin.layouts.main')
@section('title', 'My Trips')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
    <style>
        i {
            cursor: pointer;
            font-size: 13px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('admin.partials.content-header', ['name' => 'My Trips', 'key' => 'My Trips'])

        <main>
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

                            {{-- <div class="text-right">
                                <a href="{{ route('admin.my-trip.create') }}" class="custom-btn create">Thêm mới</a>
                            </div> --}}


                            <div class="card card-outline card-primary mt-3">
                                <div class="card-body table-responsive lb-list-category">
                                    <div>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Trip</th>
                                                    <th>Number adult</th>
                                                    <th>Customer Name</th>
                                                    <th>Number Day</th>
                                                    <th>Start Date</th>
                                                    <th>Total Cost</th>
                                                    <th>Total Cost/ Person</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($myTrips) && $myTrips->count() > 0)
                                                    @foreach ($myTrips as $key => $item)
                                                        <tr>
                                                            <td>{{ $item->tour_name }}</td>
                                                            <td>
                                                                {{ $item->adult_number }}
                                                            </td>
                                                            <td>
                                                                {{ $item->title_name }} {{ $item->first_name }}
                                                                {{ $item->last_name }}
                                                            </td>
                                                            <td>
                                                                {{ $item->day_number ?? '( No data )' }}
                                                            </td>
                                                            <td>
                                                                {{ \Carbon::parse($item->date_start)->format('m/d/Y') }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($item->final_cost) }} VND
                                                            </td>
                                                            <td>
                                                                {{ number_format($item->final_cost_per_person) }} VND
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.my-trip.edit', ['id' => $item->id]) }}"
                                                                    class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button
                                                                    data-url="{{ route('admin.my-trip.destroy', ['id' => $item->id]) }}"
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
                                        {{ $myTrips->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
        </main>

    </div>
@endsection
@section('js')
    <script src="{{ asset('custom/js/main.js') }}"></script>
@endsection
