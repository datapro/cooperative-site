@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="container mt-4" style="color: white;">
    <h3 style="text-align: center;text-decoration:underline;">
        {{$member->name}}
    </h3>
    <h4>Loan Repayment for: ₦{{ number_format($member->requested_amount, 2) }}</h4>
     <p><strong>Current Total Savings:</strong> ₦{{ number_format($availableSavings, 2) }}</p>
    <p><strong>Outstanding Balance:</strong> ₦{{ number_format($outstanding, 2) }}</p>

    <form method="POST" action="{{ route('loan.repay.store', $member->id) }}" class="mt-3">
        @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label>Principal (₦) or Amount Repaying</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
         <div class="col-md-4">
                <label>Interest Rate (% per annum)</label>
                <input type="number" step="0.01" name="rate" class="form-control" required>
            </div>
             <div class="col-md-4">
                <label>Duration (Years)</label>
                <input type="number" name="duration" class="form-control" required>
            </div>
        </div>
        <div style="margin-top: 20px;display:flex;gap:20px; align-items:center;">
        <button class="btn btn-primary" >Submit Repayment</button>
        <a href="{{route('contributionsavings')}}" class="btn btn-warning btn-sm">Back</a>
        </div>
    </form>

    <hr>

    <h5>Repayment History</h5>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Requested Date </th>
                <th>Request loan </th>
                <th>Amount Paid (₦)</th>
                <th>Status</th>
                <th>Quarantor Form</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($member->loans as $loan)
    <tr>
        <td>{{ $loan->created_at }}</td>
        <td>{{ $loan->requested_amount }}</td>
        <td>{{ $loan->amount_repaid }}</td>
        <td>{{ $loan->status }}</td>
        <td>@if ($loan->g_form)
        <a href="{{ asset('forms/' . $loan->g_form) }}" 
            class="btn btn-sm btn-primary" 
            download>
            <i class="bi bi-download"></i> Download
        </a>
    @else
        <span class="text-muted">No file</span>
    @endif</td>
        <td>
        <a href="" class="btn btn-success ">Approve</a>
        <a href="" class="btn btn-danger">Reject</a>
        </td>

</tr>
    @endforeach
        </tbody>
    </table>
</div>
@endsection
