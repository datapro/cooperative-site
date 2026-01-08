<link rel="stylesheet" href="{{asset('assets/css/userstyle.css')}}">
@include('inc.head')
@extends('layouts.app')
@section('content')
<aside class="sidebar">
    <div class="links">
        <a href="#">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        Dashboard
    </a>
    </div>
    {{-- <div class="links">
        <a href="{{route('member.showsavings')}}">
        <img src="{{asset('assets/images/membericons/savings.png')}}" />
        Savings
    </a>
    </div> --}}
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
    <h2 class="text-2xl font-bold mb-4" style="display: inline-block">Loan Application</h2>
    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">Back</a>
    @include('flash.messages')
<div class="form-grid" style="justify-content:center; display:flex;">
    <form action="{{ route('member.loan') }}" method="POST" enctype="multipart/form-data" 
    style="border-weight:1px;border-style:solid; border-color:pink;padding:16px; display:grid; 
    grid-template-columns:500px 500px; gap:10px; justify-content:center; align-items:center;">
        @csrf
        {{-- Amount --}}
            <div class="col-auto">
                    <label for="amount" class="form-label">Loan Amount: (₦)</label>
                    <input type="number" name="requested_amount" step="0.01" required id="amount" class="form-group" placeholder="Enter amount to save">
                </div>

            <div class="col-auto">
                    <label for="amount" class="form-label">Interest Rate: (%)</label>
                   <select name="interest_rate" id="" class="form-group" >
                        <option name="interest_rate" value="5">5</option>
                        <option name="interest_rate" value="6">6</option>
                        <option name="interest_rate" value="7">7</option>
                        <option name="interest_rate" value="8">8</option>
                   </select>
            </div>
            {{-- <div class="col-auto">
                    <label for="duration" class="form-label">Duration of Payment(months)</label>
                    <input type="number" name="duration" step="0.01" required id="duration" class="form-group" placeholder="Enter months duration">
            </div> --}}

            <div class="col-auto">
                    <label for="amount" class="form-label">Loan Type</label>
                    <select name="loan_type" id="" class="form-group" >
                        <option name="loan_type" value="normal">normal</option>
                        <option name="loan_type" value="emergency">emergency</option>
                    </select>
            </div>

        <div class="col-auto">
                    <label  class="form-label">Guarrantor Form</label>
                    <input type="file" name="g_form" id="amount" class="form-group" required>
                </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-danger" class="form-group" >
                {{ 'Submit Loan Request' }}
            </button>
        </div>

    </form>

</div>

<div style="text-align: center;margin-left:100px;">
    <table class="table table-dark table-hover" style=" text-align:center;">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Request Loan</th>
                {{-- <th>Payment Duration(months)</th> --}}
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
                {{-- <td>{{$loan->duration}}</td> --}}
                <td> 
                     @if($loan->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($loan->status === 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
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
{{-- Pagination --}}
<div class="mt-4" style="display:flex; justify-content:center;"> 
    {{ $loans->links() }}
 </div>
</div>



@endsection
