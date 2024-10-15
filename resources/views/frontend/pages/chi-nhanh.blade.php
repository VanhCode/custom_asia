@extends('frontend.layouts.main')
{{-- @section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']?asset($seo['image']):'')
@if(isset($category))
@section('code_schema')
    {!!$category->code_schema!!}
@endsection
@endif --}}
@section('css')

<style>
    
.banner-page__content h1 {
    color: #fff;
    text-align: center;
    font-weight: 700;
    padding: 130px 0px 130px 0px;
}
.banner-page__content {
    background-color: #000000b8;
}

section.select-map {
    padding-top: 20px;
    padding-bottom: 50px;
}

.select-map-box iframe {
    height: 100%;
    border-radius: 10px;
}
.select-map h5 {
    font-size: 15px;
    color: #42464e;
    margin-bottom: 20px;
    line-height: 1.3;
    font-weight: 700;
}
.select-map h5 img {
    height: 27px;
    margin-right: 10px;
    width: 19px;
}
.select-city {
    width: 100%;
    height: 45px;
    border-color: #d5e4f6;
    border-radius: 5px;
    background-color: transparent;
    padding: 0px 15px;
    font-size: 15px;
    color: #515151;
    margin-bottom: 10px;
}
.group-map {
    width: 100%;
    border: solid 1px #d5e4f6;
    padding: 20px 20px 10px;
    border-radius: 5px;
    max-height: 438px;
    overflow-y: auto;
    cursor: pointer;
}
.group-map span {
    padding-bottom: 15px;
    display: block;
}
.group-map p {
    position: relative;
    font-weight: 400;
    font-size: 15px;
    color: #42464e;
    position: relative;
    padding-left: 12px;
    cursor: pointer;
    padding-bottom: 0px;
}
.group-map ul li {
    font-size: 14px;
    color: #424242;
    padding-left: 13px;
}

</style>
    <style>
        header{
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.25);
        }
        .group-map .active p{
            color: var(--color-5);
        }
    </style>
@endsection
@section('content')
<div class="text-left wrap-breadcrumbs">

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                        <ul class="breadcrumb">
                            <li class="breadcrumbs-item">
                                <a href="https://cus38.largevendor.com">Trang chủ</a>
                            </li>
                                                                                    <li class="breadcrumbs-item active"><a href="https://cus38.largevendor.com/san-pham" class="currentcat">Sản phẩm</a></li>
                                                                                </ul>
                </div>
            </div>
        </div>
</div>

<section class="select-map">
    <div class="container">
        <div class="row">
        <div class="col-lg-4">
                <h5 class="d-flex align-items-center">
                    <img src="https://nhaphovietnamgroup.vn/frontend/images/location.png" alt="">
                    Hệ thống văn phòng và chi nhánh
                </h5>
                <select class="select-city" onchange="updateHeThong(this)">
                    <option value="00" selected="">Khu vực</option>
                    @foreach($branch->childs()->where('active', 1)->orderBy('order')->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="group-map" id="groupMap">
                    @foreach($branch_child as $item)
                        <span onclick="changeMap(this)" data-add="{{ $item->value }}">
                            <li style="text-transform: uppercase">{{$item->name}}</li>
                            {!! $item->description !!}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-8">
                <div class="select-map-box h-100">
                    <iframe class="w-100 h-100" id="mapss" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6035220457857!2d105.81778022400844!3d21.008524338475702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad308d3797eb%3A0x59d5dc373651b24b!2zMTAyIFRow6FpIFRo4buLbmg!5e0!3m2!1svi!2s!4v1704166036506!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
        </div>
    </div>
</section>



<script>
    $(document).on('click', '.group-map span', function() {
        var newSrc = $(this).data('add');
        $('#mapss').attr('src', newSrc);

        // Remove the 'active' class from all paragraphs within the .group-map div
        $('.group-map span').removeClass('active');

        // Add the 'active' class to the clicked paragraph
        $(this).addClass('active');
    });
  // function changeMap(element) {
  //   var newSrc = element.getAttribute('data-add');
  //   document.getElementById('map').src = newSrc;
  //
  //   // Remove the 'haha' class from all paragraphs within the .group-map div
  //   var paragraphs = document.querySelectorAll('.group-map p');
  //   paragraphs.forEach(function(paragraph) {
  //     paragraph.classList.remove('active');
  //   });
  //
  //   // Add the 'haha' class to the clicked paragraph
  //   element.classList.add('active');
  // }
</script>
@endsection
@section('js')
    <script>
        function updateHeThong(select) {
            var selectedValue = $(select).val();

            $.ajax({
                url: '{{ route("filterHeThong") }}',
                method: 'GET',
                data: { selectedValue: selectedValue },
                success: function(response) {
                    $('#groupMap').html(response.html);
                },
                error: function(error) {

                }
            });
        }
    </script>
@endsection
