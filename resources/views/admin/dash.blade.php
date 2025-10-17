@include('inc.head')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Adminitrative Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('SUPER ADMIN USER!') }}
                    <marquee behavior="alternate" style="color:green;">
                        Thank you for Joining Our Cooperative!, Your sure way to achievement
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="sidebar">
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        <a href="#">Super Admin</a>
    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/user.png')}}" />
        <a href="#">Member Management</a>
    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/account.png')}}" />
        <a href="#">Savings & Contributions Management</a>
    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        <a href="#">Loan Management</a>
    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/account.png')}}" />
        <a href="#">Accounting & Transactionse</a>

    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/reports.png')}}" />
        <a href="#">Reports & Analytics</a>

    </div>
    <div class="links-m">
        <img src="{{asset('assets/images/membericons/settings.png')}}" />
        <a href="#">Settings & Configuration</a>

    </div>
</aside>

@endsection
