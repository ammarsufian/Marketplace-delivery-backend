@extends('layouts.partnerRider')
@section('title', 'Rider Page')
@section('type', 'rider')
@section('image')
{{asset('cova/partnerRiderPage/img/rider.png')}}
@endsection
@section('post')
{{route('rider.store', app()->getLocale())}}
@endsection
@section('content')
<div class="wrapper-header">
    <h3>{{__('messages.rider.Why Deliver with Cova')}}</h3>
</div>
<div class="wrapper">
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-1.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.rider.title1')}}
            </h4>
            <p>
                {{__('messages.rider.paragraph1')}}
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-2.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.rider.title2')}}
            </h4>
            <p>
                {{__('messages.rider.paragraph2')}}
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/rider-3.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.rider.title3')}}
            </h4>
            <p>
                {{__('messages.rider.paragraph3')}}
            </p>
        </div>
    </div>
</div>
@endsection