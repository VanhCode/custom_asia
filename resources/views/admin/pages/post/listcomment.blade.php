@extends('admin.layouts.main')
@section('title', 'Danh sách Bình luận bài viết')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper lb_template_list_post">

        @include('admin.partials.content-header', ['name' => 'Bình luận bài viết', 'key' => 'Danh sách Bình luận bài viết'])

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

                        <div class="d-flex justify-content-between ">
                            <a href="{{ route('admin.post.create') }}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                        </div>

                        <div class="card card-outline card-primary">

                            <div class="card-body table-responsive p-0 lb-list-category">
                                <table class="table table-head-fixed" style="font-size:13px;">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>STT</th>
                                            {{-- <th>ID</th> --}}
                                            <th>Name</th>
                                            <th class="white-space-nowrap">email</th>
                                            <th class="white-space-nowrap">Nội dung</th>
                                            <th class="white-space-nowrap">Bài viết</th>
                                            <th class="white-space-nowrap">Trạng thái</th>
                                            <th class="white-space-nowrap">Hành động</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $postItem)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                {{-- <td>{{ $postItem->id }}</td> --}}
                                                <td>{{ $postItem->name }}</td>
                                                <td>{{ $postItem->email }}</td>
                                                <td>{{ $postItem->content }}</td>
                                                <td>
                                                    @php
                                                        $id_comment = App\Models\PostComment::where('comment_id', $postItem->id)->first();
                                                        $post = App\Models\Post::where('id', $id_comment->post_id)->first();
                                                    @endphp
                                                    <a href="{{ $post->slug_full }}" target="_blank">{{ $post->name }}</a>
                                                </td>

                                                </td>
                                                <td class="wrap-load-active"
                                                    data-url="{{ route('admin.post.load.activecomment', ['id' => $postItem->id]) }}">
                                                    @include('admin.components.load-change-active', [
                                                        'data' => $postItem,
                                                        'type' => 'bài viết',
                                                    ])
                                                </td>
                                                <td class="white-space-nowrap">
                                                    {{-- <a href="{{route('admin.post.edit',['id'=>$postItem->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a> --}}
                                                    <a data-url="{{ route('admin.post.destroycomment', ['id' => $postItem->id]) }}"
                                                        class="btn btn-sm btn-danger lb_delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{ $data->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
