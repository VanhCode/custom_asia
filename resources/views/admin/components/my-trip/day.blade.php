@if ($numberDay > 0 && count($listDateNext) > 0)
    @for ($i = 0; $i < $numberDay; $i++)
        <li class="day-box" data-target="day-box-{{ $i + 1 }}-{{ $randoms[0] }}"
            data-date="{{ $listDateNext[$i] }}" data-day="{{ $day_start + $i }}">
            <span>Day {{ $day_start + $i }}</span>
            [{{ $listDateNext[$i] }}]
        </li>
    @endfor
@endif
