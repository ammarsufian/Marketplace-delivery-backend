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
    <link rel="stylesheet" href='{{asset("cova/landingPage/app.css")}}'>
    <title>Landing Page</title>
</head>

<body class="font-size font-Helvetica">
    <header id="header" class="flex flex-between flex-wrap header">
        <div id="header-left" class="flex flex-start header-left">
            <div class="navbar-header" onclick="toggleNav()">
                <a class="" href="#">
                    <i class="material-symbols-outlined menu">menu</i>
                </a>
            </div>
            <div class="logo">
                <a href="#">
                    <img class="logo-img" src="{{asset("cova/landingPage/img/Logo.svg")}}" alt="logo">
                </a>
            </div>
        </div>
        <div id="header-right" class="partner header-right">
            <a href="{{Route('partner')}}">
                <button class="btn-partner">
                    <div class="text-partner">
                        {{('Become a Partner')}}
                    </div>
                    <div class="material-symbols-outlined arrow_forward">
                        arrow_forward
                    </div>
                </button>
            </a>
        </div>
    </header>
    <nav class="nav">
        <button type="button" class="nav-close" onclick="toggleNav()">
            <div class="i">
                <i class="material-symbols-outlined">close</i>
            </div>
        </button>
        <div class="nav-links-container">
            <a href="#" class="nav__link">
                <span class="nav__text">{{__('messages.Blog')}}</span>
            </a>
            <a href="{{Route('contact')}}" class="nav__link">
                <span class="nav__text">{{__('messages.Contact us')}}</span>
            </a>
            <a href="#" class="nav__link">
                <i class="material-symbols-outlined nav__icon">language</i>
                <span class="nav__text language-en-size">{{ __('messages.ar')}}</span>
            </a>
        </div>
    </nav>
    <section class="margin-top-170">
        <div class="img-ellipse10">
            <img class="ellipse10" id="ellipse10" src="{{asset('cova/landingPage/img/Ellipse10.png')}}" alt="" srcset="" />
        </div>
        <div class="img-cofe">
            <img class="cofe" src="{{asset('cova/landingPage/img/cofe1.png')}}" />
        </div>

        <div class="card cova-app">
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
                    Order your cofee,and we will
                    get it delivere to you!
                </p>
            </div>

            <div class="card-footer flex flex-start donload-now-more">
                <button class="btn-color-o radius-5">{{__('messages.Donwload now')}}</button>
                <button class="btn-color-w radius-5">{{__('messages.Learn More')}}</button>
            </div>
        </div>
        <div class="absolute-clean-top"></div>
        <div class="cova-number flex flex-col flex-align-center">
            <h3 class="number-text">
                +50000 cups of coffee
            </h3>
            <p>
                delivered to thousands of coffee lover
            </p>
    </section>
    <section class="section-cova-about flex flex-wrap">
        <div class="img-mariana-cofe-2">
            <img class="mariana-cofe-2" src="{{asset('cova/landingPage/img/cofe2-mariana-ibanez.png')}}" />
        </div>
        <div class="cova-about">
            <div class="card-header">
                <h1>
                    About us
                </h1>
            </div>
            <div class="about-body">
                <p class="">
                    We in Cova know precisely how much passion
                    coffee lovers have, and how magical the different
                    flavors and aromas emanating from the cups are,
                    which go directly to the hearts before the minds.
                    we were keen to provide cafes and products that suit
                    and satisfy the different moods of a people
                    belonging to the homeland of coffee that lives in the
                    hearts
                </p>
            </div>
            <div class="card-contact flex">
                <div><a href="{{Route('contact')}}">Contact us <span> &#62;<span></a></div>
            </div>
        </div>
    </section>
    <section class="groups-img categores_position">
        <div class="categores_titel">
            All your coffee needs & essentials
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
                Coffee any time
            </h1>
            <p class="track-order-body card-body">
                What is better than early morning coffee, a late
                afternoon latte, or an after-dinner espresso.
                Cova is the ultimate convenience. Fresh, tasty
                coffee at your doorstep and you don't have
                to lift a finger.

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
                Track orders to your door
            </h1>
            <div>
                <p class="card-body track-order-body">
                    Get your favourite coffee delivered in flash.
                    You'll see when your rider's picked up your
                    order, and be able to follow themalong way.
                    You'll get a notification when they are nearby,
                    too.
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
                    Deliver with Cova
                </div>
                <div class="card-rider-partner-body">
                    Join us as a rider and increase your income, register now!
                </div>
                <div class="card-rider-partner-footer">
                    <a href="{{Route('rider')}}">
                        <button class="btn-color-o radius-5">
                            Apply as a rider
                        </button>
                    </a>
                </div>
            </div>

        </div>
        <div class="card-rider-partner flex flex-col flex-align-center">
            <img src="{{asset('cova/landingPage/img/Vector.png')}}" alt="" class="rider-partner-img">
            <div class="flex flex-col-align-center text-align-center position-absolute">
                <div class="card-rider-partner-header">
                    Partner with Cova
                </div>
                <div class="card-rider-partner-body">
                    Grow your business and reach new customers by partnering with us.
                </div>
                <div class="card-rider-partner-footer">
                    <a href="{{Route('partner')}}">
                        <button class="btn-color-o radius-5">
                            Apply as a partner
                        </button>
                    </a>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <section class="social-media">
            <div>
                <h5>Cova App</h5>
            </div>
            <div>
                <a href="#" class="fa fa-youtube-play"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-twitter"></a>
            </div>
        </section>
        <section class="list-link-footer">
            <div class="flex flex-justify-center flex-wrap">
                <div class="store-size-btn">
                    <a href="#">
                        <img src="{{ asset('cova/landingPage/img/App_Store_Badge.svg.png') }}" alt="">
                    </a>
                </div>
                <div class="store-size-btn">
                    <a href="#">
                        <img src="{{ asset('cova/landingPage/img/Google_Play_Store_badge.svg.png') }}" alt="">
                    </a>
                </div>
                <div class="store-size-btn">
                    <a href="#">
                        <img src="{{ asset('cova/landingPage/img/app-gallery.webp') }}" alt="">
                    </a>
                </div>
            </div>
            <nav class="nav-footer">
                <ul>
                    <li><a href="#">{{__('messages.Blog')}}</a></li>
                    <li><a href="{{Route('contact')}}">{{__('messages.Contact')}}</a></li>
                    <li><a href="#">{{__('messages.About us')}}</a></li>
                    <li><a href="{{ Route('rider') }}">{{__('messages.Become a rider')}} </a></li>
                    <li><a href="{{ Route('partner') }}">{{__('messages.Become a partner')}}</a></li>
                </ul>
            </nav>
        </section>
        <section class="social-media copy-cova">
            <!-- © 2022 Cova Terms & Conditions -->
            <div>
                &copy; 2022 Cova
            </div>
            <div>
                {{__('messages.Terms & Conditions')}}
            </div>
        </section>
    </footer>
    <script src="{{asset("cova/landingPage/app.js")}}"></script>
</body>

</html>