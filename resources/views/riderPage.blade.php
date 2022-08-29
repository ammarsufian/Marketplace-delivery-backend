@extends('layouts.partnerRider')
@section('title', 'Rider Page')
@section('type', 'rider')
@section('image')
{{asset('cova/partnerRiderPage/img/rider.png')}}
@endsection
@section('post')
{{route('rider.store')}}
@endsection
@section('content')
<div class="wrapper-header">
    <h3>Why Deliver with Cova</h3>
</div>
<div class="wrapper">
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-1.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                Easy to use
            </h4>
            <p>
                Just sign up and receive everything
                you need to start earning.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-2.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                Make your own money
            </h4>
            <p>
                You decide how much money you
                make and when you make it.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-3.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                Set your own schedule
            </h4>
            <p>
                Work with your own schedule. No
                minimum hours and no boss.
            </p>
        </div>
    </div>
</div>
@endsection