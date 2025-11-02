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
        <a href="{{route('member.savings')}}">
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
    <div style="display: flex;justify-content:center; column-gap:50px; margin-buttom:20px; align-items:center;">

        <h2 class="text-2xl font-bold mb-4" style="display: inline-block">Add to My Savings</h2>
              
    </div>
    <form action="{{route('member.showsavings')}}" method="POST">
        @include('flash.messages')
        @csrf
        {{-- Amount --}}
        {{-- <div class="col-auto">
            <label for="" class="form-label">MemberShip ID</label>
            <input type="text" name="user_id" id="amount" class="form-group" placeholder="Enter Membership code">
        </div>
         --}}
        <div class="col-auto">
            <label for="amount" class="form-label">Amount (₦)</label>
            <input type="number" name="amount" id="amount" class="form-group" placeholder="Enter amount to save" required>
        </div>

        {{-- <div class="col-auto">
            <label for="amount" class="form-label">Total Savings (₦)</label>
            <input type="number" name="total_savings" id="amount" class="form-group" >
        </div> --}}

        {{-- Date --}}
        {{-- <div class="col-auto">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" value="" class="form-group">
        </div> --}}

        {{-- Description --}}
        {{-- <div class="col-auto">
            <label for="remarks" style="vertical-align: top;" class="form-label">Description</label>
            <textarea name="remark" id="remarks" rows="3" cols="50" class="form-group" placeholder="E.g. Monthly savings or special deposit">{{ old('remarks', $record->remarks ?? '') }}</textarea>
        </div> --}}
        <button type="submit" class="btn btn-primary">
            {{ 'Save Now' }}
        </button>
          <a href="{{ route('home') }}" class="btn btn-secondary" style="vertical-align: top;">Cancel</a>
    </form>
    <h3 class="mb-4" style="text-align: center;display:block">My Savings Summary</h3>

<div style="display:flex;justify-content:center; column-gap:20px;">
<div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow-sm">
                <div class="btn btn-success">
                    <div style="display: flex; justify-content:center;column-gap:20px;
                    background: rgb(4, 77, 4); color:white;">
                    <h3 style="color: white;">Total Savings After Approval
                        {{-- <br> ₦{{ number_format($total, 2) }} --}}
                    </h3> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


    <div style="text-align: center;margin-left:100px;">
        
    <table class="table" style="text-align:center;">
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
                <td> @if($saving->status == 'active')
                    <span class="badge bg-warning text-dark">Active</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif</td>
                <td class="{{ $saving->amount < 0 ? 'text-danger' : 'text-success' }}">
                ₦{{ number_format($saving->amount, 2) }}</td>
                {{-- <td>₦{{ number_format($total, 2) }}</td> --}}
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
</div>



@endsection
