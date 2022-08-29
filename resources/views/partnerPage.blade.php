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
        How we can help your business
    </h3>
</div>
<div class="wrapper">
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-1.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                Promote your business 
            </h4>
            <p>
                Stand out with in-app marketing to 
                reach even more customers and 
                increase sales.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-2.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                Reach more customers
            </h4>
            <p>
                Increase new customers attraction 
                and boost your sales.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-banner">
            <img class="banner-img" src="{{asset('cova/partnerRiderPage/img/partner-3.png')}}" alt=''>
        </div>
        <div class="card-content">
            <h4>
                We take care of delievery
            </h4>
            <p>
                Get more sales on delivery orders 
                without any of the delivery 
                headaches.
            </p>
        </div>
    </div>
</div>

@endsection