@foreach ($product as $key => $productItem)
    <tr class="ui-state-default" data-id="{{ $productItem->id }}">
        <td><input type="checkbox" class="checkbox" data-id="{{ $productItem->id }}"></td>
        <td>{{ $loop->index + 1 }}</td>
        {{-- <td>{{ $productItem->order }}</td> --}}
        <td>{{ $productItem->name }}</td>
        <td>
            <img src="{{ $productItem->avatar_path ? asset($productItem->avatar_path) : $shareFrontend['noImage'] }}"
                alt="{{ $productItem->name }}" style="width:80px;">
        </td>
        <td class="wrap-load-active" data-url="{{ route('admin.product.load.active', ['id' => $productItem->id]) }}">
            @include('admin.components.load-change-active', [
                'data' => $productItem,
                'type' => 'sản phẩm',
            ])
        </td>
        <td class="wrap-load-hot" data-url="{{ route('admin.product.load.hot', ['id' => $productItem->id]) }}">
            @include('admin.components.load-change-hot', [
                'data' => $productItem,
                'type' => 'sản phẩm',
            ])
        </td>
        <td>{{ optional($productItem->category)->name }}</td>
        <td>
            <a href="{{ route('admin.product.edit', ['id' => $productItem->id]) }}" class="btn btn-sm btn-info"
                onclick="localStorage.setItem('urlListProduct', window.location.href);"><i class="fas fa-edit"></i></a>
            <a data-url="{{ route('admin.product.destroy', ['id' => $productItem->id]) }}"
                class="btn btn-sm btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
        </td>
    </tr>
@endforeach
