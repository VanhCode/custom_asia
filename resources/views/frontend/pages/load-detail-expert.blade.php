<div class="row">
    <div class="clm" style="--w-sm: 4; --w-xs: 12;">
        <div class="experts-popup-img">
            <img src="{{ asset($expert->avatar_path) }}"
                alt="{{ $expert->name }}">
        </div>
    </div>
    <div class="clm" style="--w-sm: 8; --w-xs: 12;">
        <div class="experts-popup-text">
            <h3>{{ $expert->name }}</h3>
            <span>{!! $expert->description !!}</span>
            <div class="desc">
                {!! $expert->content ?? '' !!}
            </div>
        </div>
    </div>
</div>