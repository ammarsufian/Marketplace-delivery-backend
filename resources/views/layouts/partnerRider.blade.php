<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="{{ asset('cova/landingPage/img/Favicon.png') }}" type="image/svg+xml" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('cova/partnerRiderPage/app.css') }}">
    <link rel="stylesheet" href="{{ asset('cova/app.css') }}">
    <title>@yield('title')</title>
</head>
<body {{ (App::getLocale()=='ar')? 'dir=rtl class=font-NotoSans': 'dir=ltr class=font-Helvetica'}}>
@include('layouts.header')

<div>
    <img src="@yield('image')" class="img-partner-rider" alt="">
</div>

<section class="form-apply">
    <div class="form-header">
        {{__('messages.send')}}
    </div>
    <form action="@yield('post')" method="post">
        @csrf
        <div class="group-name item">
            <div>
                <input type="text" name="firstName" placeholder="{{__('messages.fname')}}" required>
            </div>
            <div>
                <input type="text" name="lastName" placeholder="{{__('messages.lname')}}" required>
            </div>
        </div>

        <div class="custom-select item">
            <select name="city" class="">
                <option value="">{{__('messages.city')}}</option>
                @foreach ($countries as $country)
                    @if ($country->id == $SaudiaId)
                        @foreach ($country->cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
        <div class="item">
            <input type="text" name="phoneNumber" placeholder="{{__('messages.phone')}}" required>
        </div>
        <input type="hidden" name="type" value="@yield('type')">
        <div class="item">
            <input type="submit" value="Apply">
        </div>
    </form>
</section>

<section class="m-160">
    @yield('content')
</section>
@include('layouts.footer')
@if ($errors->any())
    <div class="message hide" id="message">
        @foreach ($errors->all() as $error)
            <div class="bar error">
                <i class="ico">&#9888;</i>
                <span>{{ $error }}</span>
            </div>
        @endforeach
    </div>
@endif
<script src="{{ asset('cova/partnerRiderPage/app.js') }}"></script>
<script>
    var lang = "{{ app()->getLocale() }}";
    if(lang == 'ar'){
        
        //nav-links-container edit all span 
        var navLinksContainer = document.querySelector('.nav-links-container');
        var navLinksContainerSpan = navLinksContainer.querySelectorAll('span');
        navLinksContainerSpan.forEach(span => {
            span.style.left = 'unset';
        });
        let input_form = document.querySelectorAll('.form-apply input[type="text"]');
        input_form[0].style.marginRight = '0';
        input_form[input_form.length-1].style.marginRight = '0';

        let select_form = document.querySelector('.select-selected').style;
        select_form.setProperty('--left', '10px');
    }
    else{

        let select_form = document.querySelector('.select-selected').style;
        select_form.setProperty('--right', '25px');
    }
</script>
</body>

</html>
