<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- add logo img  width 50px-->
    <link rel="icon" href="{{asset('cova/landingPage/img/Favicon.png')}}" type="image/svg+xml" sizes="16x16">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href='{{asset("cova/app.css")}}'>
    <link rel="stylesheet" href='{{asset("cova/landingPage/app.css")}}'>
    <title>Cova Home</title>
</head>

<body {{ (App::getLocale()=='ar')? 'dir=rtl class=font-NotoSans': 'dir=ltr class=font-Helvetica'}}>
    <header id="header" class="header flex flex-between">
        <div id="header-left" class="flex flex-start header-{{ (App::getLocale()=='ar')?'right':'left'}}">
            <div class="menu-link">
                <!-- USING CHECKBOX HACK -->
                <input type="checkbox" id="checkbox_toggle" />
                <label for="checkbox_toggle" id="hamburger" class="hamburger material-symbols-outlined">menu</label>
                <!-- NAVIGATION MENUS -->
                <input type="checkbox" id="checkbox_toggle" />
                @include('layouts.navbar')
            </div>

            <div class="logo">
                <a href="#">
                    <img class="logo-img" src="{{asset("cova/landingPage/img/Logo.svg")}}" alt="logo">
                </a>
            </div>
        </div>
    </header>
    <section class="margin-top-170" dir="ltr">
        <div class="section-1-img-text">
            <div class="img-section-1">
                <div class="img-ellipse10">
                    <img class="ellipse10" id="ellipse10" src="{{asset('cova/landingPage/img/Ellipse10.png')}}" alt="" srcset="" />
                </div>
                <div class="img-cofe">
                    <img class="cofe" src="{{asset('cova/landingPage/img/cofe1.png')}}" />
                </div>
            </div>
            <div class="card cova-app" {{ (App::getLocale()=='ar')? 'dir=rtl': 'dir=ltr' }}>
                <div class="card-header">
                    <div class="card-text">
                        {{__('messages.Cova App')}}
                    </div>
                    <h1 class="text-header">
                        {{__('messages.Time For Coffee?')}}
                    </h1>
                </div>
                <div class="card-body">
                    <p>
                        {{__('messages.Order your cofee,and we will get it delivere to you!')}}
                    </p>
                </div>
    
                <div class="card-footer flex flex-start donload-now-more">
                    <button class="btn-color-o radius-5">{{__('messages.Donwload now')}}</button>
                    <button class="btn-color-w radius-5">{{__('messages.Learn More')}}</button>
                </div>
            </div>
        </div>
        <div class="absolute-clean-top"></div>
        <div class="cova-number flex flex-col flex-align-center">
            <h3 class="number-text">
                {{__('messages.+50000 cups of coffee')}}
            </h3>
            <p>
                {{__('messages.delivered to thousands of coffee lover')}}
            </p>
    </section>
    <section class="section-cova-about flex flex-wrap">
        <div class="img-mariana-cofe-2">
            <img class="mariana-cofe-2" src="{{asset('cova/landingPage/img/cofe2-mariana-ibanez.png')}}" />
        </div>
        <div class="cova-about">
            <div class="card-header">
                <h1>
                    {{__('messages.About us')}}
                </h1>
            </div>
            <div class="about-body">
                <p class="">
                    {{__('messages.about us section')}}
                </p>
            </div>
            <div class="card-contact flex">
                <div><a href="{{Route('contact',app()->getLocale())}}">{{__('messages.Contact us')}}<span> &#62;<span></a></div>
            </div>
        </div>
    </section>
    <section class="groups-img categores_position">
        <div class="categores_titel">
            {{__('messages.All your coffee needs & essentials')}}
        </div>
        <div class="categores-list">
            @foreach ($categories as $category)
                <div class="category-item {{$loop->iteration}} padding-category-left">
                    <div class="category_image"> <img src="{{$category->image}}" /> </div>
                    <div class="category_title title-black">
                        <p>{{$category->name}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    
    <section class="track-order flex-direction-row-reverse flex-align-center">
        <div class="track-order-item-1">
            <h1 class="card-header">
                {{__('messages.Coffee any time')}}
            </h1>
            <p class="track-order-body card-body">
                {{__('messages.any time section')}}
            </p>
        </div>
        <div class="track-order-item-2 ">
            <div class="flex flex-justify-center">
                <img class="phone-image" src="{{asset('cova/landingPage/img/iPhone-mockup.png')}}" alt="">
            </div>
        </div>
    </section>
    <section class="track-order margin-80-110-tb">
        <div class="track-order-item-1">
            <h1 class="track-order-title card-header">
                {{__('messages.Track orders to your door')}}
            </h1>
            <div>
                <p class="card-body track-order-body">
                    {{__('messages.track orders section')}}
                </p>
            </div>
        </div>
        <div class="track-order-item-2 width-930">
            <img class="traking-image" src="{{asset('cova/landingPage/img/traking-image.png')}}" alt="">
        </div>
    </section>
    <section class="rider-partner flex flex-wrap">
        <div class="card-rider-partner flex flex-col flex-align-center">
            <img src="{{asset('cova/landingPage/img/istockphoto.png')}}" alt="" class="rider-partner-img">
            <div class="flex flex-col-align-center text-align-center position-absolute">
                <div class="card-rider-partner-header">
                    {{__('messages.Deliver with Cova')}}
                </div>
                <div class="card-rider-partner-body">
                    {{__('messages.Join us as a rider and increase your income, register now!')}}
                </div>
                <div class="card-rider-partner-footer">
                    <a href="{{Route('rider',App::getLocale())}}">
                        <button class="btn-color-o radius-5">
                            {{__('messages.Apply as a rider')}}
                        </button>
                    </a>
                </div>
            </div>

        </div>
        <div class="card-rider-partner flex flex-col flex-align-center">
            <img src="{{asset('cova/landingPage/img/Vector.png')}}" alt="" class="rider-partner-img">
            <div class="flex flex-col-align-center text-align-center position-absolute">
                <div class="card-rider-partner-header">
                    {{__('messages.Partner with Cova')}}
                </div>
                <div class="card-rider-partner-body">
                    {{__('messages.Grow your business and reach new customers by partnering with us.')}}
                </div>
                <div class="card-rider-partner-footer">
                    <a href="{{Route('partner',App::getLocale())}}">
                        <button class="btn-color-o radius-5">
                            {{__('messages.Apply as a partner')}}
                        </button>
                    </a>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @extends('layouts.footer')
    
    <script src="{{asset("cova/landingPage/app.js")}}"></script>
    <script>
        let lang = "{{app()->getLocale()}}";
        if (lang == "ar") {
            // document.querySelector(".cova-app").style.margin = "0px";
        }
    </script>
</body>

</html>