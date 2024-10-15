@php
    $i = 1;
    if (!isset($limit)) {
        $limit = 99;
    }

@endphp
{{-- <ul class="nav-main"> --}}
@foreach ($data as $value)
    @if ($value['id'] != 408)
        <li
            class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }} @if ($loop->first && $active) active @endif">
            @if ($value['id'] == config('constants.id_quattranmavang'))
                <a href="{{ $value['slug'] }}"><span>{!! $value['name'] !!}</span>
                @else
                    <a href="@if (count($value['childs']) > 0) javascript:;@else {{ $value['slug'] }} @endif"><span>{!! $value['name'] !!}</span>
            @endif
            @isset($value['childs'])
                @if (count($value['childs']) > 0 && $limit >= $i + 1)
                    {!! $icon_d ?? '' !!}
                @endif
            @endisset
            </a>
            @isset($value['childs'])
                @if (count($value['childs']) > 0 && $limit >= $i + 1)
                    <ul class="nav-sub">
                        @foreach ($value['childs'] as $childValue)
                            @include('frontend.components.menu-child', ['childs' => $childValue])
                        @endforeach
                    </ul>
                @endif
            @endisset
        </li>
    @endif
@endforeach
<li class="nav-item">

    <a href="@if (count($data1->childs) > 0) javascript:;@else {{ $data1->slug_full }} @endif"><span>{{ $data1->name }}</span>

        @isset($data1->childs)
            @if (count($data1->childs) > 0 && $limit >= $i + 1)
                {!! $icon_d ?? '' !!}
            @endif
        @endisset
    </a>
    @isset($data1->childs)
        @if (count($data1->childs) > 0 && $limit >= $i + 1)
            <ul class="nav-sub">
                @foreach ($data1->childs()->where('active', 1)->orderBy('order')->get() as $childs)
                    <li class="">
                        <a href="{{ $childs->slug_full }}"><span>{{ $childs->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endisset
</li>

{{-- </ul> --}}
