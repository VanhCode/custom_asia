@foreach ($products as $item)
    <div class="clm" style="--w-lg: 4; --w-sm: 6; --w-xs: 12;">
        <div class="products-card">
            <a href="{{ $item->slug_full }}" class="products-card__img d-block">
                <img class="d-block" src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
            </a>
            <div class="products-card-content">
                <a href="{{ $item->slug_full }}">
                    <h3>{{ $item->name }}</h3>
                </a>
                <ul class="d-flex">
                    <li>{{ $item->masp }}</li>
                    <li>{{ $item->content2 }}</li>
                    <li class="d-flex ai-center">
                        {{ $item->number }} days
                    </li>
                    <li class="d-flex ai-center trip-map" data-id="{{ $item->id }}">
                        Trip map
                    </li>
                </ul>
                <div class="desc">
                    <p>{!! $item->description !!}</p>
                </div>
                <div class="d-flex ai-end js-between products-card-bottom">
                    <a href="{{ $item->slug_full }}" class="see-more">
                        Details
                    </a>
                    <div class="price">
                        <div class="price-top">
                            Price from: <span>${{ number_format($item->price) }}</span>
                        </div>
                        <div class="price-bottom">
                            Per person (Group of 2)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="clm" style="--w-lg: 12; --w-sm: 12; --w-xs: 12;">
    {{ $products->appends(request()->input())->links() }}
</div>
