@include('inc.head')
@extends('layouts.app')
@section('content')
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
        Contibution
    </a>
    </div>
    <div class="links">
        <a href="{{route('profile')}}">
        <img src="{{asset('assets/images/membericons/profile.png')}}" />
       Profile
    </a>

    </div>
</aside>

<div class="max-w-2xl mx-auto bg-white shadow rounded p-6" style="text-align:center;">
    <h2 class="text-2xl font-bold mb-4" style="display: inline-block">Contribution History</h2>


   

    <table class="table" style=" text-align:center;margin-left:50px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Decription</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($savings as $saving)
            <tr>
                <td>{{$saving->user->membership_no}}</td>
                <td class="{{ $saving->amount < 0 ? 'text-danger' : 'text-success' }}">
                ₦{{ number_format($saving->amount, 2) }}</td>
                <td>@if($saving->status == 'active')
                    <span class="badge bg-warning text-dark">Active</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif</td>
                <td>{{$saving->date}}</td>
                <td>{{$saving->remark}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <div>
        <label for="" style="font-weight: bold">Total Savings: </label>
        <input type="text" value="pending" disabled>
    </div>





@endsection
