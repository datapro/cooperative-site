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
<div class="max-w-2xl mx-auto bg-white shadow rounded p-6" style="text-align:center;">
    <h2 class="text-2xl font-bold mb-4" style="display: inline-block">Savings Report</h2>


   
<div style="text-align: center;margin-left:100px;">
    <table class="table table-dark table-hover" style="text-align:center;">
         <thead>
             <tr>
                 <th>Membership ID</th>
                 <th>Name</th>
                 <th>Date</th>
                 <th>Remark</th>
                 <th>Savings Status</th>
                 <th>Amount (₦)</th>
                 {{-- <th>Total Savings (₦)</th> --}}
             </tr>
         </thead>
         @foreach ($savings as $saving)
         <tbody>
             <tr>
                 <td>{{$saving->user->membership_no}}</td>
                 <td>{{$saving->user->name}}</td>
                 <td>{{ \Carbon\Carbon::parse($saving->date)->format('d M, Y') }}</td>
                 <td>{{ $saving->remark }}</td>
                 <td> {{$saving->status}}</td>
                 <td class="{{ $saving->amount < 0 ? 'btn-danger' : 'btn-success' }}">
                 ₦{{ number_format($saving->amount, 2) }}</td>
                 {{-- <td>₦{{ number_format($total, 2) }}</td> --}}
             </tr>
         </tbody>
         @endforeach
     </table>
     {{-- Pagination --}}
<div class="mt-4" style="display:flex; justify-content:center;"> 
    {{ $savings->links() }}
 </div>
 <div>
 <label for="" style="font-weight: bold">Total Savings: </label>
 <input type="text" value="₦{{ number_format($totalSavings, 2) }}" disabled>
 </div>

</div>







    @endsection
