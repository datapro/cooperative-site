<link rel="stylesheet" href="{{asset('assets/css/userstyle.css')}}">
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
    <h2 class="text-2xl font-bold mb-4" style="display: inline-block">Loan Application</h2>
    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">Back</a>
    @include('flash.messages')
<div class="form-grid" style="justify-content:center; display:flex;">
    <form action="{{ route('member.loan') }}" method="POST" enctype="multipart/form-data" 
    style="border-weight:1px;border-style:solid; border-color:pink;padding:16px;">
        @csrf
        {{-- Amount --}}

        <div style="display: grid;grid-template-columns:1fr; 
        gap:20px;justify-content:center;align-items:center;">
            <div class="col-auto">
                    <label for="amount" class="form-label">Loan Amount: (₦)</label>
                    <input type="number" name="requested_amount" step="0.01" required id="amount" class="form-control" placeholder="Enter amount to save">
                </div>

        <div class="col-auto">
                    <label for="amount" class="form-label">Guarrantor Form</label>
                    <input type="file" name="g_form" id="amount" class="form-group">
                </div>
        </div>

            <button type="submit" class="btn btn-success">
                {{ 'Submit Loan Request' }}
            </button>

    </form>
    {{-- <p>Total Savings: ₦{{ number_format($totalSavings, 2) }}</p> --}}
    {{-- @if($loan && $loan->status == 'active')
    <form action="{{ route('memberloan') }}" method="POST"
    style="border-weight:1px;border-style:solid; border-color:pink;padding:16px;" >
    @csrf
    
    <div class="col-auto">
        <label for="amount" class="form-label">Amount Payable: (₦)</label>
        <input type="number" name="repayment_amount" step="0.01"  id="amount" class="form-control" placeholder="Enter amount payable">
    </div>
    <button type="submit" class="btn btn-success">
        {{ 'Pay Out-standing Loan' }}
    </button>
</form>
@endif --}}
</div>
@php
    $borrowed = $loan->amount_borrowed ?? 0;
    $repaid = $loan->amount_repaid ?? 0;
    $outstanding = $borrowed - $repaid;
@endphp
<p style="font-size:50px; text-align:center;">
    Outstanding Loan: ₦{{ number_format($outstanding, 2) }}
</p>

    
<div style="text-align: center;margin-left:100px;">
    <table class="table" style=" text-align:center;">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Request Loan</th>
                {{-- <th>Total Savings Balance</th>
                <th>Repayable Loan</th> --}}
                <th>Status</th>
                <th>Review Form</th>
                <th>Date Requested</th>
            </tr>
        </thead>
         @foreach ($loans as $loan)
        <tbody>
            <tr>
                <td>{{$loan->user->membership_no}}</td>
                <td>{{$loan->requested_amount}}</td>
                {{-- <td>{{$loan->deducted_from_savings}}</td>
                <td>{{$loan->amount_borrowed}}</td> --}}
                <td> @if($loan->status == 'cleared')
                    <span class="badge bg-success">Cleared</span>
                @elseif($loan->status == 'active')
                    <span class="badge bg-warning text-dark">Active</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif
                </td>
                    <td> @if ($loan->g_form)
                        <a href="{{ asset('forms/' . $loan->g_form) }}" 
                           class="btn btn-sm btn-primary" 
                           download>
                           <i class="bi bi-download"></i> Download
                        </a>
                    @else
                        <span class="text-muted">No file</span>
                    @endif</td>
                <td>{{$loan->created_at}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

</div>



@endsection
