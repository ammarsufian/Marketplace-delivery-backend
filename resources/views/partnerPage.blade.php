@extends('layouts.partnerRider')
@section('title', 'Partner Page')
@section('type', 'partner')
@section('image')
{{asset('cova/partnerRiderPage/img/partner.png')}}
@endsection
@section('post')
{{route('partner.store')}}
@endsection
@section('content')
<div class="wrapper-header">
    <h3>
        {{__('messages.partner.How we can help your business')}}
    </h3>
</div>
<div class="wrapper">
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-1.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.partner.title1')}}
            </h4>
            <p>
                {{__('messages.partner.paragraph1')}}
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-2.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.partner.title2')}}
            </h4>
            <p>
                {{__('messages.partner.paragraph2')}}
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-3.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                {{__('messages.partner.title3')}}
            </h4>
            <p>
                {{__('messages.partner.paragraph3')}}
            </p>
        </div>
    </div>
</div>

@endsection