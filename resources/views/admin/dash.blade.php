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

                     <img src="{{ asset('images/' . auth()->user()->passport) }}" width="200px"
                 class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                 alt="Profile Photo" style="width: 100px; border-radius:50px;"/>
                 {{ __('SUPER ADMIN USER!') }}
                    <marquee behavior="alternate" style="color:rgb(87, 4, 4);">
                        Thank you for Joining Our Cooperative!, Your sure way to achievement
                    </marquee>
                    @include('flash.messages')
                </div>

                
            </div>
        </div>
        <main style="display: grid; 
                    gap:20px;
                    align-items:center;
                    grid-template-columns:1fr 1fr;
                    margin-top:50px;">
                {{-- <div class="cards">
                 <a href="{{route('accountTransaction')}}">
                <img src="{{asset('assets/images/membericons/account.png')}}" />
               <p style="font-size: 16px;color:white;">Accounting & Transactionse</p>
            </a>
        
            </div> --}}
            {{-- <div class="cards">
                <a href="{{route('reportAnalytics')}}">
                <img src="{{asset('assets/images/membericons/reports.png')}}" />
               <p style="font-size: 16px; color:white;">Reports & Analytics</p> 
            </a>
        
            </div> --}}
            <div class="cards"  >
                <a href="{{route('admin.members.savings')}}">
                <img src="{{asset('assets/images/membericons/dash.png')}}" />
             <p style="font-size: 16px ; color:white;">Approve Members Savings</p>   
            </a>
        
            </div>
            {{-- <div class="cards" >
                <a href="{{route('settings')}}">
                <img src="{{asset('assets/images/membericons/settings.png')}}" />
              <p style="font-size: 16px;color:white;">Settings & Configuration</p>  
            </a>
            </div> --}}
            <div class="cards">
              <a href="">
                <img src="{{asset('assets/images/membericons/settings.png')}}" />
              <p style="font-size: 16px;color:white;">Chat and Notifications</p>
              </a> 
            </div>
            <div class="cards" >
              <a href="">
                <img src="{{asset('assets/images/membericons/reports.png')}}" />
              <p style="font-size: 16px;color:white;">Others</p>  
              </a>
            </div>
            <div class="cards" >
              <a href="{{route('home')}}">
                <img src="{{asset('assets/images/membericons/dash.png')}}" />
              <p style="font-size: 16px; color:white;">Visit Member Dashbord</p>  
              </a>
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
