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
                    <marquee behavior="alternate" style="color:green;">Thank you for Joining Our Cooperative!, Your sure way to achievement </marquee>
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="sidebar">
    <div class="links">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        <a href="#">Dashboard</a>
    </div>
    <div class="links">
        <img src="{{asset('assets/images/membericons/savings.png')}}" />
        <a href="#">Savings</a>
    </div>
    <div class="links">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        <a href="#">Loans</a>
    </div>
    <div class="links">
        <img src="{{asset('assets/images/membericons/business.png')}}" />
        <a href="#">Contibution</a>
    </div>
    <div class="links">
        <img src="{{asset('assets/images/membericons/profile.png')}}" />
        <a href="#">Profile</a>
        <main style="text-align:center;">
    </div>
</aside>
<main style="text-align:center;">
    <div class="mb-6">
        <p class="text-gray-600">Overview of your cooperative account.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="rand">
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Savings</h3>
            <p class="text-2xl font-bold text-green-700">₦</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500 text-sm">Loan Balance</h3>
            <p class="text-2xl font-bold text-red-600">₦</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Contributions</h3>
            <p class="text-2xl font-bold text-blue-700">₦</p>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="bg-white p-6 shadow rounded" style="justify-content:center; align-items:center;">
        <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>

        <table class="w-full text-left border-collapse" border="1" style="margin:auto;">
            <thead>
                <tr class=" border-b">
                    <th class="py-2">Date</th>
                    <th class="py-2">Description</th>
                    <th class="py-2">Type</th>
                    <th class="py-2 text-right">Amount (₦)</th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">17/10/2025</td>
                    <td class="py-2">For house rent</td>
                    <td class="py-2 capitalize">welfare</td>
                    <td class="py-2 text-right">₦50000</td>
                </tr>

                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        No recent transactions
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

{{-- <div class="cover">
    <img src="{{asset('assets/images/finance.png')}}" />
</div> --}}
@endsection
