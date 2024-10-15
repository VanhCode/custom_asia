@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '')
@section('keywords', $seo['keywords'] ?? '')
@section('description', $seo['description'] ?? '')
@section('abstract', $seo['abstract'] ?? '')
@section('image', $seo['image'] ?? '')

@section('canonical')
    <link rel="canonical" href="{{ route('contact.index') }}" />
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/contact.css') }}">
@endsection
@section('content')
<style>
    .template-plan{
        padding-top: 40px;
    }
    .scout-component__modal-navigation-close {
  padding: 0px;
  background-color: white;
  height: 27px;
  width: 27px;
  border-radius: 100%;
}
.content-wrapper{
    overflow: hidden;
}
</style>
    <div class="content-wrapper">
        <main class="template-plan ">
            <div class="plan-desc">
                <div class="ctnr">
                    <div class="desc">
                        {!! $dataAddress->description ?? '' !!}
                    </div>
                </div>
            </div>
            <div class="plan-body">
                <div class="ctnr">
                    <div class="row js-between">
                        <div class="clm" style="--w-lg: 8.6; --w-xs: 12;">
                            <div class="plan-form">
                                <h2 class="ta-center">{!! $dataAddress->name ?? '' !!}</h2>
                                <div class="desc ta-center">
                                    <p>{!! $dataAddress->slug ?? '' !!}</p>
                                    <p>{!! $dataAddress->value ?? '' !!}</p>
                                </div>

                                <form action="{{ route('contact.planTrip') }}" id="planTripForm1" method="POST">
                                    @csrf
                                    <div class="question-plan-form">
                                        <h3>Where do you want to visit (You can choose multiple options)
                                            <span>*</span>
                                        </h3>
                                        @if (isset($ourTour))
                                            <div class="d-flex ai-center fw-wrap">
                                                @foreach ($ourTour->childs()->where('active', 1)->get() as $tours)
                                                    <div class="form-group form-group--mgr">
                                                        <input class="input-tour" type="checkbox" name="ourTour[]"
                                                            id="" value="{{ $tours->id }}">
                                                        <label for="">{{ $tours->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="question-plan-form">
                                        <h3>Your travel styles (You can choose multiple options)
                                            <span>*</span>
                                        </h3>
                                        @if (isset($travelStyle))
                                            <div class="d-flex ai-center fw-wrap">
                                                @foreach ($travelStyle->childs()->where('active', 1)->get() as $item)
                                                    <div class="form-group form-group--mgr">
                                                        <input type="checkbox" name="travelStyle[]" id=""
                                                            value="{{ $item->id }}">
                                                        <label for="">{{ $item->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="question-plan-form">
                                        <h3>What's your budget for the whole trip? (Per Person)
                                            <span>*</span>
                                        </h3>
                                        <div class="form-group">
                                            <select name="price" id="">
                                                <option value="">Including accommodations, transportation, &
                                                    activities/
                                                    tours. All amounts in USD</option>
                                                <option value="$500 - $1000"> $500 - $1000 </option>
                                                <option value="$1000 - $1500"> $1000 - $1500 </option>
                                                <option value="$1500 - $2000"> $1500 - $2000 </option>
                                                <option value="$2000 - $2500"> $2000 - $2500 </option>
                                                <option value="$2500 - $3000"> $2500 - $3000 </option>
                                                <option value="$3000 - $4000"> $3000 - $4000 </option>
                                                <option value="$4000 - $5000"> $4000 - $5000 </option>
                                                <option value="$5000 - $7000"> $5000 - $7000 </option>
                                                <option value="$7000 - $10000"> $7000 - $10000 </option>
                                                <option value=">$10000">Over $10000 USD Per Person</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question-plan-form">
                                        <h3>Does that budget include international flights?
                                            <span>*</span>
                                        </h3>
                                        <div class="d-flex ai-center fw-wrap">
                                            <div class="form-group form-group--mgr">
                                                <input type="radio" name="include_flights" id="flights_yes"
                                                    value="yes">
                                                <label for="">Yes</label>
                                            </div>
                                            <div class="form-group form-group--mgr">
                                                <input type="radio" name="include_flights" id="flights_no" value="no">
                                                <label for="">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question-plan-form">
                                        <h3>About budget, what's most important to you?
                                            <span>*</span>
                                        </h3>
                                        <div class="form-group form-group--mgr">
                                            <input type="radio" name="budget" id="budget_keeping" value="Keeping to my budget">
                                            <label for="">Keeping to my budget</label>
                                        </div>
                                        <div class="form-group form-group--mgr">
                                            <input type="radio" name="budget" id="budget_increase" value="For the right trip, I'll increase my budget">
                                            <label for="">For the right trip, I'll increase my budget</label>
                                        </div>
                                        <div class="form-group form-group--mgr">
                                            <input type="radio" name="budget" id="budget_perfect" value="Taking the perfect trip">
                                            <label for="">Taking the perfect trip</label>
                                        </div>
                                        <div class="row">
                                            <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="date" name="date" id=""
                                                        placeholder="When are you traveling?">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                                <div class="form-group">
                                                    <select name="days" id="">
                                                        <option value="">How long will your trip be?</option>
                                                        <option value="2 Days">2 Days</option>
                                                        <option value="3 Days">3 Days</option>
                                                        <option value="4 Days">4 Days</option>
                                                        <option value="5 Days">5 Days</option>
                                                        <option value="6 Days">6 Days</option>
                                                        <option value="7 Days">7 Days</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                                <div class="form-group">
                                                    <select name="adult" id="">
                                                        <option value="">Number of adult</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 6; --w-xs: 12;">
                                                <div class="form-group">
                                                    <select name="adult_age" id="">
                                                        <option value="">What are the adults' ages?</option>
                                                        <option value="18-30">18-30</option>
                                                        <option value="31-50">31-50</option>
                                                        <option value="51-64">51-64</option>
                                                        <option value="65+">65+</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question-plan-form">
                                        <h3>Any specific requests or interests?</h3>
                                        <div class="form-group">
                                            <textarea placeholder="Preferences/ travel with kids/ family/ anniversary/ diet/ other important notes..."
                                                name="specific_requests" id="" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="clm" style="--w-md: 3; --w-xs: 12;">
                                                <div class="form-group">
                                                    <select name="title" id="">
                                                        <option value="">Title</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Ms.">Ms.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 3.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="text" placeholder="First Name" name="first_name"
                                                        id="">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 5.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Last Name" name="last_name"
                                                        id="">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 6.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Your Best Email" name="email"
                                                        id="">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 5.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Confirmed Email" name="confirmedEmail"
                                                        id="">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 6.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <input type="number" placeholder="Phone (+country code)"
                                                        name="phone" id="">
                                                </div>
                                            </div>
                                            <div class="clm" style="--w-md: 5.5; --w-xs: 12;">
                                                <div class="form-group">
                                                    <select name="address_detail" id="">
                                                        <option value="">Country of Residence</option>
                                                        <option value="VietNam">VietNam</option>
                                                        <option value="ThaiLan">ThaiLan</option>
                                                        <option value="Laos">Laos</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="plantrip" id="plantrip">
                                    <div class="plan-form-footer ">
                                        <button type="submit">SEND REQUEST</button>
                                        <div>
                                            This inquiry is completely FREE. We require NO credit card at this stage,
                                            and you are under no obligation whatsoever.
                                        </div>
                                        <div class="d-flex ai-center fw-wrap js-center">
                                            Want to WhatsApp instead? Here's our number:
                                            <a href="">
                                                <div class="hotline d-flex  ai-center">
                                                    {!! $header['hotline']['value'] ?? '' !!}
                                                    {{ $header['hotline']['name'] ?? '' }}
                                                </div>
                                            </a>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clm" style="--w-lg: 3.2; --w-xs: 12;">
                            <div class="sider-bar-plan">
                                <h3 class="ta-center">How did people say about us!</h3>
                                <iframe class="wuksD5" title="Embedded Content "
                                    style="overflow: hidden; width: 100%; height: 500px;" name="htmlComp-iframe"
                                    scrolling="no" data-src=""
                                    src="https://www-customasiatravel-com.filesusr.com/html/b77722_4c6f86873fd17e5ef6bf48690f3be5d5.html"></iframe>
                            </div>
                            <div class="sider-bar-plan">
                                <h3 class="ta-center">Past Travelers' Reviews</h3>
                                <iframe frameborder="0" allowfullscreen=""
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    title="Vietnam Family Tour From Australia" width="100%" height="100%"
                                    src="https://www.youtube.com/embed/EwlOEznMexc?autoplay=1&amp;mute=1&amp;controls=1&amp;loop=1&amp;origin=https%3A%2F%2Fwww.customasiatravel.com&amp;playsinline=1&amp;playlist=EwlOEznMexc&amp;enablejsapi=1&amp;widgetid=1"
                                    id="widget2" data-gtm-yt-inspected-20="true" data-gtm-yt-inspected-25="true"
                                    data-gtm-yt-inspected-30="true"></iframe>
                                <iframe frameborder="0" allowfullscreen=""
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    title="Design A Trip of A Lifetime in Vietnam, Thailand, Laos, Cambodia - Custom Asia Travel"
                                    width="100%" height="100%"
                                    src="https://www.youtube.com/embed/_izVUnWNlLs?autoplay=0&amp;mute=0&amp;controls=1&amp;loop=0&amp;origin=https%3A%2F%2Fwww.customasiatravel.com&amp;playsinline=1&amp;enablejsapi=1&amp;widgetid=3"
                                    id="widget4" data-gtm-yt-inspected-19="true" data-gtm-yt-inspected-24="true"
                                    data-gtm-yt-inspected-29="true"></iframe>
                                <a href="">
                                    Watch More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($map))
                <section class="process pd-section-top pd-section-bottom">
                    <div class="ctnr">
                        <h2 class="title-section ta-center">{{ $map->name }}</h2>
                        <div class="process-content" style="background-image: url({{ asset($map->image_path1) ?? '' }});">
                            <div class="row js-center h-100">
                                @foreach ($map->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                    <div class="clm" style="--w-lg: 2.4; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                                        <div class="process-box">
                                            <div class="process-icon">
                                                {!! $item->value !!}
                                            </div>
                                            <div class="process-text ">
                                                <h3 class="process-title">{{ $item->name }}</h3>
                                                <div class="desc">
                                                    {!! $item->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <div class="experts-plan pd-section-bottom">
                <div class="ctnr">
                    @if (isset($travelExperts))
                        <h2 class="title-section ta-center">{{ $travelExperts->name }}</h2>
                        <div class="desc">
                            <p>
                                <strong>{!! $travelExperts->value !!}</strong>
                            </p>
                            {!! $travelExperts->description !!}
                        </div>
                    @endif
                    <div class="row js-center pd-section-content">
                        @foreach ($listOurTeam as $item)
                            <div class="clm" style="--w-xl: 2; --w-lg: 2.4; --w-md: 3; --w-sm: 4; --w-xs: 6;">
                                <div class="experts-box btn-experts" data-expert-id="{{ $item->id }}">
                                    <div class="experts-img ta-center">
                                        <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="experts-text">
                                        <h3 class="ta-center">{{ $item->name }}</h3>
                                        <span class="ta-center tt-up d-block">{!! $item->description !!}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="note ta-center">
                        {!! $travelExperts->slug ?? '' !!}
                    </div>
                </div>
            </div>

            @if (isset($whyBook))
                <section class="why-book" style="background-image: url({{ asset($whyBook->image_path1) ?? '' }});">
                    <div class="why-book-body pd-section-top">
                        <div class="ctnr">
                            <h2 class="title-section ta-center">{{ $whyBook->name }}</h2>
                            <div class="row pd-section-content">
                                @foreach ($whyBook->childs()->where('active', 1)->orderBy('order')->get() as $item)
                                    <div class="clm" style="--w-xl: 4; --w-md: 6; --w-xs: 12;">
                                        <div class="why-book-box d-flex">
                                            <div class="why-book-icon">
                                                {!! $item->value !!}
                                            </div>
                                            <div class="why-book-content">
                                                <h3 class="tt-up">{!! $item->name !!}</h3>
                                                {!! $item->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </main>

        <div id="pdf_popup" class="scout-component__modal js-brochure-modal__overlay--form">
            <div class="js-scout-component__modal-dialog scout-component__modal-dialog">
                <div class="scout-component__modal-top">
                    <div class="scout-component__modal-navigation">
                        <div class=" scout-component__modal-navigation-back hid"></div>
                        <button class="mfp-close scout-component__modal-navigation-close js-brochure-modal__form-close">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="experts-popup">
                        {{-- <div class="row">
                            <div class="clm" style="--w-lg: 4;">
                                <div class="experts-popup-img">
                                    <img src="https://static.wixstatic.com/media/b77722_12e5f92af5a94d1b99446e2966011a56~mv2.jpg/v1/crop/x_41,y_0,w_619,h_803/fill/w_259,h_336,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/Susan%20Hien.jpg"
                                        alt="">
                                </div>
                            </div>
                            <div class="clm" style="--w-lg: 8;">
                                <div class="experts-popup-text">
                                    <h3>Susan Hien</h3>
                                    <span>Travel Specialist</span>
                                    <div class="desc">
                                        <p>
                                            Xin Chao!!! My full name is Hien – it means Virtuousness, a characteristic of an
                                            honest person, and you can call me Susan as my business name. I like traveling
                                            and have spent a lot of time traveling throughout Indochina. During these
                                            travels, I have fallen in love with the beautiful destinations I visited and
                                            enjoyed meeting people of different cultures.
                                        </p>
                                        <p>
                                            Joining Custom Vietnam Travel is my best decision ever as I am able to create
                                            travel dreams for many people from all over the world. You love traveling of
                                            course and I share my passion. I am very proud to be a member of the CVT family
                                            and work in a very professional environment with my greatest colleagues. Come
                                            with us and let me know what you want your holiday to be like. I am here and
                                            willing to create more dreams!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        const callAPI = (id) =>{
            return new Promise((resolve, reject)=>{

                var url = '{{ route('expert.get', ['id' => ':id']) }}'.replace(':id', id);
    
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        if (response.html) {
                            // Cập nhật nội dung modal với HTML trả về
                            $('.experts-popup').html(response.html);
                            resolve()
                            // Hiển thị modal
                            // $('.scout-component__modal').toggle();
                            // modal.style.display = "block";
                        } else {
                            alert('Không thể tải thông tin chuyên gia này. Vui lòng thử lại!');
                            reject()
                        }
                    },
                    error: function() {
                        alert('Lỗi tải thông tin chuyên gia. Vui lòng thử lại!');
                    }
                });
            })
        }
        document.querySelectorAll(".btn-experts").forEach(function(btn) {
            btn.addEventListener("click", async function(event) {
                event.preventDefault();
                var modal = document.querySelector(".scout-component__modal");
                if (modal.style.display === "block") {
                    modal.style.display = "none";
                } else {
                    var expertId = $(this).data('expert-id');
                    await callAPI(expertId);
                    modal.style.display = "block";
                    
                }
            });
        });

        document.querySelector(".scout-component__modal-navigation-close").addEventListener("click", function() {
            var modal = document.querySelector(".scout-component__modal");
            modal.style.display = "none";
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#planTripForm1').on('submit', function(e) {
                e.preventDefault();
                let isValid = false;
                var formArr = [];

                // Validate required checkboxes
                if ($('input[name="ourTour[]"]:checked').length === 0) {
                    // alert('Please select at least one tour.');
                    formArr.push('Please select at least one tour.')
                    isValid = false;
                }
                if ($('input[name="travelStyle[]"]:checked').length === 0) {
                    formArr.push('Please select at least one travel style.');
                    isValid = false;
                }
                if ($('select[name="price"]').val() === "") {
                    formArr.push('Please select your budget.');
                    isValid = false;
                }
                if ($('input[name="include_flights"]:checked').length === 0) {
                    formArr.push('Please specify if the budget includes international flights.');
                    isValid = false;
                }
                if ($('input[name="budget"]:checked').length === 0) {
                    formArr.push('Please specify what\'s most important about the budget.');
                    isValid = false;
                }
                if ($('input[name="date"]').val() === "") {
                    formArr.push('Please specify your travel date.');
                    isValid = false;
                }
                if ($('select[name="days"]').val() === "") {
                    formArr.push('Please select the length of your trip.');
                    isValid = false;
                }
                if ($('select[name="adult"]').val() === "") {
                    formArr.push('Please specify the number of adults.');
                    isValid = false;
                }
                if ($('select[name="adult_age"]').val() === "") {
                    formArr.push('Please specify the adults\' ages.');
                    isValid = false;
                }
                if ($('select[name="title"]').val() === "") {
                    formArr.push('Please select a title.');
                    isValid = false;
                }
                if ($('input[name="first_name"]').val() === "") {
                    formArr.push('Please enter your first name.');
                    isValid = false;
                }
                if ($('input[name="last_name"]').val() === "") {
                    formArr.push('Please enter your last name.');
                    isValid = false;
                }
                if ($('input[name="email"]').val() === "") {
                    formArr.push('Please enter your email.');
                    isValid = false;
                }
                if ($('input[name="confirmedEmail"]').val() === "") {
                    formArr.push('Please enter your Confirmed Email.');
                    isValid = false;
                }
                if ($('input[name="phone"]').val() === "") {
                    formArr.push('Please enter your phone number.');
                    isValid = false;
                }
                if ($('select[name="country"]').val() === "") {
                    formArr.push('Please select your country of residence.');
                    isValid = false;
                }
                if (formArr.length > 0) {
                    for (const element of formArr) {
                        alert(element)
                        break
                    }
                    return
                } else {
                    let ourTour = [];
                    $('input[name="ourTour[]"]:checked').each(function() {
                        ourTour.push($(this).next('label').text());
                    });

                    let travelStyle = [];
                    $('input[name="travelStyle[]"]:checked').each(function() {
                        travelStyle.push($(this).next('label').text());
                    });

                    let price = $('select[name="price"] option:selected').text();
                    let internationalFlights = $('input[name="include_flights"]:checked').next('label').text();
                    let budgetImportance = $('input[name="budget"]:checked').next('label').text();
                    let travelDate = $('input[name="date"]').val();
                    let days = $('select[name="days"] option:selected').text();
                    let adult = $('select[name="adult"] option:selected').text();
                    let adultAge = $('select[name="adult_age"] option:selected').text();
                    let specificRequests = $('textarea[name="specific_requests"]').val();

                    // Tạo nội dung cho hidden input plantrip
                    let plantrip = `
                        Our Tours: ${ourTour.join(', ')}<br />
                        Travel Styles: ${travelStyle.join(', ')}<br />
                        Budget for the whole trip: ${price}<br />
                        International Flights: ${internationalFlights}<br />
                        Budget Importance: ${budgetImportance}<br />
                        Travel Date: ${travelDate}<br />
                        Days: ${days}<br />
                        Number of Adults: ${adult}<br />
                        Adults' Ages: ${adultAge}<br />
                        Specific Requests: ${specificRequests}<br />
                    `;

                    $('#plantrip').val(plantrip);

                    this.submit();
                }
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#planTripForm').on('submit', function(e) {
                let ourTour = [];
                $('input[name="ourTour[]"]:checked').each(function() {
                    ourTour.push($(this).next('label').text());
                });

                let travelStyle = [];
                $('input[name="travelStyle[]"]:checked').each(function() {
                    travelStyle.push($(this).next('label').text());
                });

                let price = $('select[name="price"] option:selected').text();
                let internationalFlights = $('input[name="international_flights"]:checked').next('label').text();
                let budgetImportance = $('input[name="budget_importance"]:checked').next('label').text();
                let travelDate = $('input[name="travel_date"]').val();
                let days = $('select[name="days"] option:selected').text();
                let adult = $('select[name="adult"] option:selected').text();
                let adultAge = $('select[name="adult_age"] option:selected').text();
                let specificRequests = $('textarea[name="specific_requests"]').val();

                let plantrip = `
                    Our Tours: ${ourTour.join(', ')}<br />
                    Travel Styles: ${travelStyle.join(', ')}<br />
                    Budget: ${price}<br />
                    International Flights: ${internationalFlights}<br />
                    Budget Importance: ${budgetImportance}<br />
                    Travel Date: ${travelDate}<br />
                    Days: ${days}<br />
                    Number of Adults: ${adult}<br />
                    Adults' Ages: ${adultAge}<br />
                    Specific Requests: ${specificRequests}
                `;

                $('#plantrip').val(plantrip);
            });
        });
    </script> --}}
@endsection
