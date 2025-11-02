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

                    {{ __('Membership Per Excellent!') }}
                    <marquee behavior="alternate" style="color:green;">
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
        Contibution</a>
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

        {{-- <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500 text-sm">Loan Balance</h3>
            <p class="text-2xl font-bold text-red-600">
                Outstanding Loan: ₦{{ number_format($loan->amount_borrowed - $loan->amount_repaid, 2) }}
            </p>
        </div> --}}

        {{-- <div   style="background: rgb(4, 77, 4);
            color:white;justify-content:center;align-items:center;display:flex;flex-direction:column;">
            <h3 class="text-gray-500 text-sm">Total Contributions</h3>
            <p class="text-2xl font-bold text-blue-700">₦{{ number_format($total, 2) }}</p>
        </div> --}}
    </div>

    {{-- Recent Transactions --}}
    <div class="bg-white p-6 shadow rounded" style="justify-content:center; align-items:center;">
        <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>
<div style="text-align: center;margin-left:100px;">
    <table class="table" style="text-align:center;">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Decription</th>
            </tr>
        </thead>
        @foreach ($savings as $saving)
        <tbody>
            <tr>
                <td>{{$saving->user->membership_no}}</td>
                <td>{{$saving->user->name}}</td>
                <td class="{{ $saving->amount < 0 ? 'text-danger' : 'text-success' }}">₦{{$saving->amount}}</td>
                <td>@if($saving->status == 'active')
                    <span class="badge bg-warning text-dark">Active</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif</td>
                <td>{{$saving->date}}</td>
                <td>{{$saving->remark}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
    </div>
</main>

{{-- <div class="cover">
    <img src="{{asset('assets/images/finance.png')}}" />
</div> --}}
@endsection
