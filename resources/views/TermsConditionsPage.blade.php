<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('messages.termsPage.title')}}</title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="{{ asset('cova/landingPage/img/Favicon.png') }}" type="image/svg+xml" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href='{{asset("cova/app.css")}}'>
    <link rel="stylesheet" href='{{asset('cova/TermsConditionsPage/app.css')}}'>
</head>
<body class="font-NotoSans" >
    @include('layouts.header')
        <section class="content">
        <h1>{{__('messages.termsPage.title')}}</h1>
        <p>{{__('messages.termsPage.paragraph1')}}</p>
        <p>{{__('messages.termsPage.paragraph2')}}</p>
        <p>{{__('messages.termsPage.paragraph3')}}</p>
        <p>{{__('messages.termsPage.paragraph4')}}</p>
        <p>{{__('messages.termsPage.paragraph5')}}</p>
        <p>{{__('messages.termsPage.paragraph6')}}</p>
    </section>
    @include('layouts.footer')
    <script src="{{asset('cova/TermsConditionsPage/app.js')}}"></script>

</body>
<script>
    var lang = "{{ app()->getLocale() }}";
    if(lang == 'ar'){
        document.body.dir = "rtl";
    }
    else{
        document.body.dir = "ltr";
    }
</script>
</html>