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
                    @include('flash.messages')
                </div>

                
            </div>
        </div>
        <main style="display: flex; gap:20px;justify-content:center;align-items:center;margin-top:20px;">
                <div class="links-m btn btn-success btn-lg" style="border-radius:50px; display:flex; border-style:solid;
                border-color:white">
                 <a href="{{route('accountTransaction')}}">
                <img src="{{asset('assets/images/membericons/account.png')}}" />
               Accounting & Transactionse</a>
        
            </div>
            <div class="links-m btn btn-success btn-lg" style="border-radius: 50px; display:flex;border-style:solid;
                border-color:white">
                <a href="{{route('reportAnalytics')}}">
                <img src="{{asset('assets/images/membericons/reports.png')}}" />
                Reports & Analytics</a>
        
            </div>
            <div class="links-m btn btn-success btn-lg"  style="border-radius: 50px; display:flex;border-style:solid;
                border-color:white">
                <a href="{{route('settings')}}">
                <img src="{{asset('assets/images/membericons/settings.png')}}" />
                Settings & Configuration</a>
        
            </div>
        </main>
    </div>
</div>
<aside class="sidebar">
    <div class="links-m">
         <a href="{{route('admin')}}">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
       Super Admin</a>
    </div>
    <div class="links-m">
        <a href="{{route('membermanagement')}}">
        <img src="{{asset('assets/images/membericons/user.png')}}" />
        Member Management</a>
    </div>
    <div class="links-m">
        <a href="{{route('contributionsavings')}}">
        <img src="{{asset('assets/images/membericons/account.png')}}" />
        Savings & Contributions Management</a>
    </div>
    {{-- <div class="links-m">
        <a href="{{route('loanManagement')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Loan Management</a>
    </div> --}}
    <div class="links-m">
        <a href="{{route('comodity')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Comodity Management</a>
    </div>
</aside>




@endsection
