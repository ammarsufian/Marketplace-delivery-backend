<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="icon" href="{{ asset('cova/landingPage/img/Favicon.png') }}" type="image/svg+xml" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('cova/partnerRiderPage/app.css') }}">
    <link rel="stylesheet" href="{{ asset('cova/app.css') }}">

    <title>Contact Us</title>
</head>

<body {{ (App::getLocale()=='ar')? 'dir=rtl class=font-NotoSans': 'dir=ltr class=font-Helvetica'}}>
@include('layouts.header')
<div class="flex  contact-us">
    <aside class="contact">
        <div class="contact-title">
            <h1>{{__('messages.Get in Touch')}}</h1>
            <div>{{__('messages.We are here for you')}}</div>
        </div>
        <div class="contact-img">
            <img src="{{ asset('cova/partnerRiderPage/img/Faded-logo.png') }}" alt="">
        </div>
    </aside>
    <section class="contact-form">
        <form action="{{ route('contact.store') }}" method="post">
            @csrf
            <h1>{{__('messages.Send us')}}</h1>
            <div class="group-name">
                <div>
                    <input type="text" name="firstName" placeholder="{{__('messages.fname')}}" required>
                </div>
                <div>
                    <input type="text" name="lastName" placeholder="{{__('messages.lname')}}" required>
                </div>
            </div>
            <div>
                <input class="item" type="email" name="email" placeholder="{{__('messages.email')}}" required>
            </div>
            <div>
                <textarea class="item" name="message" id="maxlength" cols="30" rows="10" placeholder="{{__('messages.message')}}"
                        required></textarea>
            </div>
            <div class="flex flex-justify-center">
                <input type="submit" value="Apply">
            </div>
        </form>
    </section>
</div>
@include('layouts.footer')
<script src="{{asset('cova/contact.js')}}"></script>
<script src="{{ asset('cova/partnerRiderPage/app.js') }}"></script>
<script>
    var lang = "{{ app()->getLocale() }}";
    if(lang == 'ar'){
        document.body.dir = "rtl";
    }
    else{
        document.body.dir = "ltr";
    }
</script>
</body>
