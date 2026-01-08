@include('inc.head')
@extends('layouts.app')
@section('content')
<div style="text-align: right;">
    <button  type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Print Account Receipt</button>
   <a href="{{route('admin.consolidation')}}" class="btn btn-secondary"> + BAcK</a> 
</div>

{{-- reciept modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Receipt</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<div class="modal-body">
     <main>
        {{-- head sectin  --}}
    <section style="display: grid;grid-template-columns:100px 1fr 100px;">
        <div>
        @if (auth()->check() && auth()->user()->passport)
                <img src="{{ asset('images/' . auth()->user()->passport) }}"
                class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                alt="Profile Photo" style="width: 50px"/>
            @else
                <img src="{{ asset('assets/images/nasulogo.png') }}" alt="Default Avatar" width="100px">
            @endif
        </div>
        <div style="text-align: center;font-weight:bold;">
            NASU FUOYE COOPERATIVE MULTIPURPOSE SOCIETY
            <p style="text-align: center; font-weight:50px;">Transactin for {{$user->created_at->format('F Y')}}</p>
        </div>
          <div>
            <img src="{{asset('assets/images/nasulogo.png')}}" width="50px" alt="logo">
        </div>
    </section>
    <section style="display:grid; 
    grid-template-columns:100px  1fr;
     column-gap:10px;justify-content:center;
     background-color:rgb(200,100,50); color:white;">
        <div>Name</div>
        <div>{{$user->name}}</div>
        <div>Email:</div>
        <div>{{$user->email}}</div>
        <div>Staff No:</div>
        <div>{{$user->membership_no}}</div>
        <div>Ledger No:</div>
        <div>{{$user->ledger_no}}</div>
        <div>Phone No:</div>
        <div>{{$user->phone}}</div>
    </section>
    <h6 style="margin-bottom: 0;color:rgb(200,100,50);">Savings</h6>
    <section style="display: grid;grid-template-columns:1fr 100px;columns-gap:10px;margin-top:0;">
        <div>Saving B/F</div>
        <div>₦{{ number_format( $totalApprovedSavings, 2) }}</div>
        <div>Add Savings During the Months</div>
        <div>₦{{ number_format( $savingsThisMonth, 2) }}</div>
        <div>Total Savings</div>
        <div>₦{{ number_format( $totalSavings, 2) }}</div>
    </section>
    <hr>
    <h6 style="margin-bottom: 0;color:rgb(200,100,50);">Loan Services</h6>
    <section style="display: grid;grid-template-columns:1fr 100px;columns-gap:10px;margin-top:0;">
        <div>Loan Principal Balance B/F</div>
        <div>₦{{ number_format( $loanBF, 2) }}</div>
        <div>Add Loan Granted During the Month</div>
        <div>₦{{ number_format( $loanGranted, 2) }}</div>
        <div>Less Loan principal Repayment</div>
        <div>₦{{ number_format( $loanPrincipalRepayment , 2) }}</div>
        <div>Loan Repayment Balance C/F</div>
        <div>₦{{ number_format( $loanRepaymentCF, 2) }}</div>
        <div>Loan Ledger Balance C/F</div>
        <div>₦{{ number_format(  $loanRepaymentCF, 2) }}</div>
        <div>Interest Charges on Loan</div>
        <div>₦{{ number_format(  $loanInterest, 2) }}</div>
    </section>
    <hr>
    <h6 style="margin-bottom: 0;color:rgb(200,100,50);">Commodity Sale Services</h6>
    <section style="display: grid;grid-template-columns:1fr 100px;columns-gap:10px;margin-top:0;">
        <div>Commodity sales Balance  B/F</div>
        <div>₦{{ number_format(  $commodityBF, 2) }}</div>
        <div>Commodity Sales During the Month</div>
        <div>₦{{ number_format( $commodityDuring, 2) }}</div>
        <div>Less Commodity Sales Repayment</div>
        <div>₦{{ number_format(   $commodityRepayment, 2) }}</div>
        {{-- <div>interest Charge on Commodity Sales</div>
        <div>₦{{ number_format(   $interestCharge, 2) }}</div> --}}
        <div>Commodity Sales Balance C/F</div>
        <div>₦{{ number_format(  $commodityCF, 2) }}</div>
    </section>
    <hr>
    <h6 style="margin-bottom: 0;color:rgb(200,100,50);">Summary of Deduction</h6>
    <section style="display: grid;grid-template-columns:1fr 100px;columns-gap:10px;margin-top:0;">
        <div>Savings</div>
        <div>₦{{ number_format(  $totalSavings, 2) }}</div>
        <div>Principal Loan Recovery</div>
        <div>₦{{ number_format(  $loanPrincipalRepayment, 2) }}</div>
        <div>Interest Charge on Loan</div>
        <div>₦{{ number_format(  $loanInterest, 2) }}</div>
        <div>Commodity Sales Repayment</div>
        <div>₦{{ number_format(  $commodityRepayment, 2) }}</div>
        <div>Loan/Membership Incidental Charges</div>
        <div>₦{{ number_format(   $charges, 2) }}</div>
        <div>Extra Charges</div>
        <div>₦{{ number_format( $extraCharges, 2) }}</div>
        <div style="font-weight: bold;">Total Deduction</div>
        <div style="font-weight: bold;">₦{{ number_format( $totalDeduction, 2) }}</div>
    </section>
    <hr>
 </main>

   
</div>
      <div class="modal-footer">
        <a href="" class="btn btn-primary">Send</a>
        <button class="btn btn-success" onclick="printModal('modalContent')">Print Account Receipt</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


{{-- end receipt modal --}}

<div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3 border-primary">
            <h6 class="text-primary">Total Approved Savings</h6>
            <h3>₦{{ number_format($totalApprovedSavings, 2) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3 border-success">
            <h6 class="text-success">Total Loan Paid</h6>
            <h3>₦{{ number_format($loanPrincipalRepayment, 2) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3 border-danger">
            <h6 class="text-danger">Outstanding Loan + Interest (₦{{ number_format(  $loanInterest, 2) }})</h6>
            <h3>₦{{ number_format($loanLedgerCF, 2) }}</h3>
        </div>
    </div>

</div>


{{-- table --}}
<form method="GET" class="mb-4">

    <div class="row">

        <div class="col-md-3">
            <label>Transaction Type</label>
            <select name="type" class="form-control">
                <option value="">All</option>
                <option value="Loan Repayment">Loan Repayment</option>
                <option value="Savings Credit">Savings Credit</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Loan Type</label>
            <input type="text" name="loan_type" class="form-control" placeholder="e.g Short Term" value="{{ request('loan_type') }}">
        </div>

        <div class="col-md-3">
            <label>Date From</label>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>

        <div class="col-md-3">
            <label>Date To</label>
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>

    </div>

    <button class="btn btn-primary mt-3">Apply Filters</button>
    <a class="btn btn-secondary mt-3" href="{{route('admin.receipt', $user->id)}}">Refresh Filters</a>

</form>

<table class="table table-dark table-hover">
    <thead class="bg-dark text-white">
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>Loan Type</th>
            <th>Amount Paid</th>
            <th>Processing Charge</th>
            <th>Note</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($transactions as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ $t->loan_type ?? '-' }}</td>
                <td>₦{{ number_format($t->amount, 2) }}</td>
                <td>₦{{ number_format($t->processing_charge, 2) }}</td>
                <td>{{ $t->note }}</td>
                <td>{{ $t->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot class="bg-light">
        <tr>
            <th colspan="3" class="text-right">Total Amount:</th>
            <th>₦{{ number_format($tableTotal, 2) }}</th>
            <th colspan="3"></th>
        </tr>
    </tfoot>
</table>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $transactions->links() }}
</div>




<script>
function printModal(staticBackdrop) {
    // Get modal content
    var printContents = document.getElementById('staticBackdrop').innerHTML;

    // Open print window
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    // Reload JS events
    window.location.reload();
}
</script>

@endsection