@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard of Member') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                     <img src="{{ asset('images/' . auth()->user()->passport) }}" width="200px"
                 class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                 alt="Profile Photo" style="width: 100px; border-radius:50px;"/>
                 {{ __('Membership Per Excellent!') }}
                    <marquee behavior="alternate" style="color:rgb(87, 5, 25);">
                        Thank you for Joining Our Cooperative!, Your sure way to achievement
                    </marquee>
                  <div>@include('flash.messages')</div>  
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="sidebar">
    <div class="links">
        <a href="{{route('home')}}">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        Dashboard
    </a>
    </div>
    <div class="links">
        <a href="{{route('member.showsavings')}}">
        <img src="{{asset('assets/images/membericons/savings.png')}}" />
        Savings
    </a>
    </div>
    <div class="links">
        <a href="{{route('memberloan')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Loans
    </a>
    </div>
    <div class="links">
        <a href="{{route('membercontributions')}}">
        <img src="{{asset('assets/images/membericons/business.png')}}" />
        Savings Report
    </a>
    </div>
    <div class="links">
        <a href="{{route('commodity_request')}}">
        <img src="{{asset('assets/images/membericons/business.png')}}" />
        Commodity Request
    </a>
    </div>
    <div class="links">
        <a href="{{route('profile')}}">
        <img src="{{asset('assets/images/membericons/profile.png')}}" />
       Profile
    </a>

    </div>
</aside>
<main style="text-align:center;">
    <div class="mb-6">
        <p class="text-gray-600" style="color: white;">Overview of your cooperative account.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="rand" style="display: flex; justify-content:center;gap:20px">
        <div class="cards">
            <h3 class="text-gray-500 text-sm" style="color:white;">Total Savings After Approval</h3>
            {{-- <p class="text-2xl font-bold text-green-700" >₦{{ number_format($total, 2) }}</p> --}}
        </div>

    </div>

    {{-- Recent Transactions --}}
    <div class="bg-white p-6 shadow rounded" style="justify-content:center; align-items:center;">
        <h3 class="text-lg font-semibold mb-4">Recent Transactions: <br>
            ₦{{ number_format($totalSavings, 2) }}</h3>
        <div style="text-align: center;margin-left:100px;">
        
        </div>
    </div>
</main>

{{-- <div class="cover">
    <img src="{{asset('assets/images/finance.png')}}" />
</div> --}}
@endsection
