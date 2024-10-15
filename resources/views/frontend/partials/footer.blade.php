<footer class="">
    <div class="ctnr">
        <div class="row js-center">
            <div class="clm" style="--w-xs: 12;">
                @if (isset($footer['tags']))
                    <div class="tags p-relative">
                        <ul class="d-flex fw-wrap">
                            @foreach ($footer['tags'] as $item)
                                <li>
                                    <a href="{{ $item->slug }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="clm" style="--w-lg: 12; --w-xs: 12;">
                <div class="row js-between">
                    <div class="clm" style="--w-lg: 4; --w-xs: 12;">
                        @if (isset($footer['address']))
                            <div class="address-footer">
                                <h3 class="tt-up">
                                    {!! $footer['address']['name'] !!}
                                </h3>
                                <p>{!! $footer['address']['value'] !!}</p>
                                <ul>
                                    @foreach ($footer['address']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                        <li><a target="_blank" class="d-flex ai-center" href="{{ $item->slug }}">
                                                {!! $item->value !!}
                                                {!! $item->description !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="footer-social js-between d-flex ai-center">
                            @if (isset($footer['socialNetwork']))
                                <ul class="d-flex ai-center">
                                    @foreach ($footer['socialNetwork']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                        <li>
                                            <a href="{!! $item->slug !!}">
                                                {!! $item->value !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="clm" style="--w-lg: 7; --w-xs: 12;">
                        @php
                            $listAttr = App\Models\Attribute::where('active', 1)->where('parent_id', 1)->orderBy('order')->get();
                        @endphp
                        @if (isset($header['categoryProduct']))
                            <div class="footer-infomation">
                                <ul class="d-flex fw-wrap js-between">
                                    <li class="">
                                        <span class="tt-up ta-center">
                                            Destinations:
                                        </span>
                                        @foreach ($listAttr as $item)
                                            <a href="{{ route('listAttribute', ['name' => str_replace(' ', '-', $item->name), 'attribute' => $item->id]) }}" value="{{ $item->id }}">{{ $item->name }}</a>
                                        @endforeach
                                    </li>

                                    {{-- @foreach ($header['categoryProduct'] as $listCate)
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                {{ $listCate->name }}:
                                            </span>
                                            @foreach ($listCate->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                                <a href="{{ $cate->slug_full }}">{{ $cate->name }}</a>
                                            @endforeach
                                        </li>
                                    @endforeach --}}

                                    @if(isset($header['introduce']))
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                {{ $header['introduce']['name'] }}:
                                            </span>
                                            @foreach ($header['introduce']->childs()->where('active', 1)->orderBy('order')->get() as $listAb)
                                                <a href="{{ $listAb->slug_full }}">{{ $listAb->name }}</a>
                                            @endforeach
                                        </li>
                                    @endif

                                    @if (isset($footer['general']))
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                {{ $footer['general']['name'] }}:
                                            </span>
                                            @foreach ($footer['general']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                                <a href="{{ $item->slug }}">{{ $item->name }}</a>
                                            @endforeach
                                        </li>
                                    @endif

                                    @if (isset($footer['commun']))
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                {{ $footer['commun']['name'] }}:
                                            </span>
                                            @foreach ($footer['commun']->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                                <a href="{{ $item->slug }}">{{ $item->name }}</a>
                                            @endforeach
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if (isset($footer['form']))
                            <div class="footer-signup">
                                <div class="footer-signup-body">
                                    <h2>{{ $footer['form']['name'] }}</h2>
                                    <form class="d-flex fw-wrap" action="{{ route('contact.storeAjax') }}"
                                        data-url="{{ route('contact.storeAjax') }}" data-ajax="submitEmail"
                                        data-target="alert" data-href="#modalAjax" data-content="#content"
                                        data-method="POST" method="POST">
                                        @csrf
                                        <input class="flex-1" type="text" name="name"
                                            placeholder="Enter your name">
                                        <input class="flex-1" type="text" name="email"
                                            placeholder="email@customasiatravel" style="width: 70%">
                                        <button type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@if (isset($footer['coppy_right']))
    <section class="coppyright">
        <div class="ctnr">
            <div class="coppyright-text">
                {!! $footer['coppy_right']['description'] !!}
            </div>
        </div>
    </section>
@endif

<script>
    $(document).on('submit', "[data-ajax='submitEmail']", function(event) {
        event.preventDefault();
        let myThis = $(this);
        let formValues = $(this).serialize();
        let dataInput = $(this).data();

        var nameVal = myThis.find('[name="name"]').val().trim();
        var emailVal = myThis.find('[name="email"]').val().trim();
        let isEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (nameVal === '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter name!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        if (emailVal === '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter email!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        } else if (!(isEmail.test(emailVal))) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter a valid email!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        $.ajax({
            type: dataInput.method,
            url: dataInput.url,
            data: formValues,
            dataType: "json",
            success: function(response) {
                if (response.code == 200) {
                    myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val(
                        '');
                    if (dataInput.content) {
                        $(dataInput.content).html(response.html);

                    }
                    if (dataInput.target) {
                        switch (dataInput.target) {
                            case 'modal':
                                $(dataInput.href).modal();
                                break;
                            case 'alert':
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.html,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            default:
                                break;
                        }
                    }
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.html,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gửi thông tin thất bại',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        return false;
    });
</script>
