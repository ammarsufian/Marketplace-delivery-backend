<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- add logo img  width 50px-->
    <link rel="icon" href="{{ asset('cova/landingPage/img/Favicon.png') }}" type="image/svg+xml" sizes="16x16">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="{{ asset('cova/landingPage/img/Favicon.png') }}" type="image/svg+xml" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('cova/partnerRiderPage/app.css') }}"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('cova/inviteFrendPage/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cova/inviteFrendPage/app.css') }}" />
    <title>Cova</title>
</head>

<body>
    @include('layouts.header')

    <div>
        <img src="{{asset('cova/inviteFrendPage/header-bg.jpg')}}" class="img-partner-rider" alt="">
    </div>

    <div class="page-content">
        <div class="form-v1-content">
            <div class="wizard-form">
                <form class="form-register" action="{{route('users.invited',$referral_key)}}" method="post" id="myform">
                    @csrf
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            <p class="step-icon"><span>01</span></p>
                            <span class="step-text">Peronal Infomation</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="wizard-header">
                                    <h3 class="heading">Peronal Infomation</h3>
                                    <p>Please enter your information and proceed to the next step so we can build your
                                        accounts. </p>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <fieldset>
                                            <legend>First Name</legend>
                                            <input type="text" class="form-control" id="first-name" name="firstName"
                                                placeholder="First Name" >
                                        </fieldset>
                                    </div>
                                    <div class="form-holder">
                                        <fieldset>
                                            <legend>Last Name</legend>
                                            <input type="text" class="form-control" id="last-name" name="lastName"
                                                placeholder="Last Name" >
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Your Email</legend>
                                            <input type="text" name="email" id="your_email" class="form-control"
                                                pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="example@email.com"
                                                >
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Phone Number</legend>
                                            <input type="text" class="form-control" id="phone" name="mobileNumber"
                                                placeholder="+966 558-999-777" >
                                        </fieldset>
                                    </div>
                                </div>
                                <div>
                                    {{-- hiden input type --}}
                                    <input type="hidden" name="referral_key" value="{{$referral_key}}">
                                    {{-- hiden input type requist key --}}
                                    <input type="hidden" name="invitedBy" value="{{ request()->has('key') ? request()->get('key') : '' }}">
                                </div>
                            </div>
                        </section>

                        <!-- SECTION 2 -->
                        <h2>
                            <p class="step-icon"><span>02</span></p>
                            <span class="step-text">SMS verification code</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="wizard-header">
                                    <h3 class="heading">Verification code</h3>
                                    <p>You can get point for every invited friend</p>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2" id="SMS">

                                    </div>
                                </div>
                            </div>
                        </section>
                        <div id="timer" class="timer"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <script src="{{ asset('cova/inviteFrendPage/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('cova/inviteFrendPage/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('cova/inviteFrendPage/js/main.js') }}"></script>
    <script src="{{ asset('cova/inviteFrendPage/js/app.js') }}"></script>
</body>

</html>
