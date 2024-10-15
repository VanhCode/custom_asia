<ul class="list-destination d-none" id="list-address-map">
    @if (isset($dataMaps))
        @foreach ($dataMaps as $item)
            <li data-lat="{{ $item->latitude }}"
                data-long="{{ $item->longitude }}">
            </li>
        @endforeach
    @endif
</ul>

<div class="row">
    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
        <div class="map">
            <div id="map3"></div>
        </div>
    </div>
    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
        <h2>{{ $data->name }}</h2>
        <div class="price d-flex ai-center js-between">
            <div class="price-right">
                <span class="tt-up d-block">Price</span>
                From
            </div>
            <div class="price-left">
                ${{ number_format($data->price) }}
            </div>
        </div>
        <div class="tour-detail-content_box faqs--js">
            <div class="d-flex ai-center js-between">
                <h2 class="tour-detail-content_title">Itinerary</h2>
            </div>

        </div>
        @if ($data->content)
            @if (isset($dataMaps))
                @foreach ($dataMaps as $item)
                    <li data-lat="{{ $item->latitude }}" data-long="{{ $item->longitude }}">
                    </li>
                @endforeach
            @endif
        @endif
        <div class="faqs">
            @if ($data->content)
                {{-- @if (isset($dataMaps))
                    @foreach ($dataMaps as $item)
                        <div class="faqs-container p-relative active">
                            <div class="faqs-circle p-absolute left-0 top-0">
                                <div class="faqs-circle-item active"></div>
                            </div>
                            <div class="faqs-top d-flex js-between">
                                <a class="faqs-title" tabindex="0">
                                    {{ $item->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif --}}
                @if (isset($dataMaps))
                    @foreach ($dataMaps as $dataMap)
                        @if ($loop->first)
                            <li data-lat="{{$dataMap->latitude}}"
                                data-long="{{$dataMap->longitude}}">
                                <div class="info-location">
                                    <div class="d-flex align-items-center">
                                        <img class="mark-point" style="width: 21px; height: 21px; margin-right: 8px;"
                                            src="{{ asset('/admin_asset/images/start-image.svg') }}">
                                        <span class="ml-8">
                                            {{$dataMap->name}}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @elseif ($loop->last)
                            <li data-lat="{{$dataMap->latitude}}"
                                data-long="{{$dataMap->longitude}}">
                                <div class="info-location">
                                    <div class="d-flex align-items-center">
                                        <img class="mark-point" style="width: 21px; height: 21px; margin-right: 8px;"
                                            src="{{ asset('/admin_asset/images/end-image.svg') }}">
                                        <span class="ml-8">
                                            {{$dataMap->name}}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li data-lat="{{$dataMap->latitude}}"
                                data-long="{{$dataMap->longitude}}">
                                <div class="info-location">
                                    <div class="d-flex align-items-center">
                                        <img class="mark-point" style="width: 21px; height: 21px; margin-right: 8px;"
                                            src="{{ asset('/admin_asset/images/mid-image.svg') }}">
                                        <span class="ml-8">
                                            {{$dataMap->name}}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</div>