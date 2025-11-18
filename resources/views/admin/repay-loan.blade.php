@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="container mt-4" style="color: rgb(36, 3, 3);">
    <h3 style="text-decoration:underline;">
        {{$member->name}}
    </h3>
<div class="card mt-3 p-3">
    <h4 style="color: rgb(17, 16, 16);">Loan Repayment for: {{$member->name}}</h4>
     {{-- <p><strong>Current Total Savings:</strong> ₦{{ number_format($totalSavings, 2) }}</p> --}}
    <p style="color: rgb(17, 16, 16);"><strong>Outstanding Balance:</strong> ₦{{ number_format($outstanding, 2) }}</p>

 </div>
<section>
    <div style="margin-bottom: 20px; margin-top:20px;display:flex;gap:20px;">
        <button  type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Repay Loan</button>
        {{-- <button  type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Emergency Loan</button> --}}
         <a href="{{route('contributionsavings')}}" class="btn btn-success">Back</a>
    </div>  
    @include('flash.messages')
</section>

{{-- modal section --}}
<section>
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Loan Payment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <form method="POST" action="{{ route('member.loan.repay',['userId' => $member->id]) }}" class="mt-3">
            @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label>Processing Charges (₦) </label>
                <input type="number" name="processing_charge" class="form-control">
            </div>
              <div class="col-md-4">
                    <label>Loan Type</label>
                    <select name="loan_type" id="" class="form-control" required>
                        <option name="loan_type" value="Normal Loan">Normal Loan</option>
                        <option name="loan_type" value="Emergency Loan">Emergency Loan</option>
                      
                    </select>
                </div>
            <div class="col-md-4">
                <label>Principal (₦) or Amount</label>
                <input type="number" name="amount_paid" class="form-control" required>
            </div>
             <div class="col-md-4">
                    <label>Interest Rate (% per annum)</label>
                    <select name="interest_rate" id="" class="form-control" required>
                        <option name="interest_rate" value="5">5</option>
                        <option name="interest_rate" value="6">6</option>
                        <option name="interest_rate" value="7">7</option>
                        <option name="interest_rate" value="8">8</option>
                        <option name="interest_rate" value="9">9</option>
                        <option name="interest_rate" value="10">10</option>
                    </select>
                </div>
                 <div class="col-md-4">
                    <label>Duration (Years for 24 months)</label>
                    <input type="number" name="duration" class="form-control" required>
                </div>
            </div>
            <div style="margin-top: 20px;display:flex;gap:20px; align-items:center;">
            <button class="btn btn-primary" >Submit Repayment</button>         
            </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}



    <h5 style="color: rgb(53, 4, 4);">Repayment History</h5>
    <div style="display: flex">
        <div>
             <table class="table table-dark table-hover">
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
        <form action="{{ route('admin.loans.status', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-sm 
                {{ $loan->status === 'approved' ? 'btn-danger' : 'btn-success' }}">
                {{ $loan->status === 'approved' ? 'Reject' : 'Approve' }}
            </button>
        </form>
    </td>
</tr>
    @endforeach
        </tbody>
    </table>
        </div>
<div>
    {{-- <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Name </th>
                <th>Amount </th>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>
          <tbody>
            @foreach ($member->transactions as $transaction)
            <tr>
                <td>{{$transaction->user->name}}</td>
                <td> ₦{{ number_format($transaction->amount, 2) }}</td>
                <td>{{$transaction->note}}</td>
                <td>{{$transaction->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
</table> --}}
        </div>
    </div>
   
</div>
@endsection
