@if ($listDay->count() > 0)
    @foreach ($listDay as $i => $itemDay)
        <li class="wrap-list-option-ad" data-target="day-box-{{ $i + 1 }}-{{ $randoms[0] }}">
            <span>Day {{ $day_start + $i }}</span>
            <input type="hidden" name="day_order[]" value="{{ $day_start + $i }}" />
            <input type="hidden" name="day_time[]" value="{{ $listDateNext[$i] }}" />
            [{{ $listDateNext[$i] }}]
            <input type="text" class="w-100" value="{{ $itemDay->name ?? '' }}" name="day_title[]" />

        </li>
        <div class="list-tour-ad-desc d-none" id="day-box-{{ $i + 1 }}-{{ $randoms[0] }}">
            <div class="desc">
                <textarea class="w-100" name="day_description[]">
                    {{ $itemDay->description ?? '' }}
        </textarea>
            </div>
            @php
                $count = 1;
            @endphp
            <div class="row">
                <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                    <div class="check-img" id="content{{ $day_start + $i }}-{{ $count }}-wrapper">
                        <img class="d-block img-filemanager img-content{{ $day_start + $i }}-{{ $count }}"
                            data-class="content{{ $day_start + $i }}-{{ $count }}"
                            src="{{ $itemDay->image_path1 ?? asset('images/add-icon.png') }}"
                            alt="{{ $itemDay->image_path1 ?? asset('images/add-icon.png') }}">
                        <div style="display: none">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="img-content{{ $day_start + $i }}-{{ $count }}-input"
                                        data-preview="img-content{{ $day_start + $i }}-{{ $count }}"
                                        class="btn btn-primary"
                                        id="img-content{{ $day_start + $i }}-{{ $count }}">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="img-content{{ $day_start + $i }}-{{ $count }}-input"
                                    class="form-control" type="text" name="day_image_path1[]"
                                    value="{{ $itemDay->image_path1 ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $count++;
                @endphp
                <div class="clm" style="--w-lg: 6; --w-xs: 12;">

                    <div class="check-img" id="content{{ $day_start + $i }}-{{ $count }}-wrapper">
                        <img class="d-block img-filemanager img-content{{ $day_start + $i }}-{{ $count }}"
                            src="{{ $itemDay->image_path2 ?? asset('images/add-icon.png') }}"
                            alt="{{ $itemDay->image_path2 ?? asset('images/add-icon.png') }}"
                            data-class="content{{ $day_start + $i }}-{{ $count }}">
                        <div style="display: none">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="img-content{{ $day_start + $i }}-{{ $count }}-input"
                                        data-preview="img-content{{ $day_start + $i }}-{{ $count }}"
                                        class="btn btn-primary"
                                        id="img-content{{ $day_start + $i }}-{{ $count }}">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="img-content{{ $day_start + $i }}-{{ $count }}-input"
                                    class="form-control" type="text" name="day_image_path2[]"
                                    value="{{ $itemDay->image_path2 ?? '' }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <table class="w-100">

                <thead>
                    <tr>
                        <th style="width: 45px;" class="btn-add-option" data-day="{{ $day_start + $i }}">+</th>
                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                        <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                        <th class="ta-center tt-up">Tên gói</th>
                        <th class="ta-center tt-up">Tổng giá</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($itemDay->tourDayOptions()->count() > 0)
                        @foreach ($itemDay->tourDayOptions()->get() as $tourDayOption)
                            <tr>
                                <td class="ta-center remove-btn " data-remove="service-all-price-{{ $randoms[$i] }}"
                                    style="cursor: pointer">-</td>
                                <td>
                                    <select class="my-select select2 select2-{{ $randoms[$i] }}" style="width: 100%;"
                                        name="day_service[{{ $day_start + $i }}][]">
                                        <option value=""></option>
                                        @foreach ($servicesOptions as $servicesOption)
                                            <option @if ($tourDayOption->parent_service_id == $servicesOption->id) selected @endif
                                                value="{{ $servicesOption->id }}">{{ $servicesOption->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="ta-center service-all-2">
                                    <select class="my-select select2 select2-child-{{ $randoms[$i] }}"
                                        style="width: 100%;" name="day_service_child[{{ $day_start + $i }}][]">
                                        <option value=""></option>
                                        @php
                                            $servicesOptionsChild = \App\Models\Service::where(
                                                'parent_id',
                                                $tourDayOption->parent_service_id,
                                            )->get();
                                        @endphp
                                        @if ($servicesOptionsChild->count() > 0)
                                            @foreach ($servicesOptionsChild as $servicesOptionChild)
                                                <option @if ($servicesOptionChild->id == $tourDayOption->service_id) selected @endif
                                                    value="{{ $servicesOptionChild->id }}">
                                                    {{ $servicesOptionChild->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                @php
                                    $option = \App\Models\ServiceOption::find($tourDayOption->option_id);
                                    $listOption = \App\Models\ServiceOption::where(
                                        'service_season_id',
                                        $option->service_season_id,
                                    )->get();
                                @endphp
                                <td class="ta-center">
                                    <select class="my-select select2 select2-child-2-{{ $randoms[$i] }}"
                                        style="width: 100%;" name="day_service_option[{{ $day_start + $i }}][]">
                                        <option value=""></option>
                                        @if ($listOption->count() > 0)
                                            @foreach ($listOption as $item)
                                                <option @if ($item->id == $tourDayOption->option_id) selected @endif
                                                    value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class="ta-center service-price service-all-price-{{ $randoms[$i] }} price-tour-box-2-{{ $option->service_type_id }}"
                                    data-price="{{ $option->price }}" data-type="2"
                                    data-class="price-tour-box-2-{{ $option->service_type_id }}"
                                    data-type="{{ $option->service_type_id }}">
                                    {{ number_format($option->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endforeach
@endif
