@include('inc.head')
@extends('layouts.app')
@section('content')

<main style="text-align: center">

<div  style="display: flex; justify-content:center; column-gap:20px;align-items:center;">
    <h2 class="text-2xl font-bold text-gray-800" style="color: white;">
        💰 Savings & Contributions
    </h2>
    {{-- <a href="#"
       class="btn btn-primary">
       + Add Contribution
    </a> --}}
    <a href="{{route('admin')}}"
       class="btn btn-warning btn-sm">
         +Dashboard
    </a>
</div>
<div style="display: flex;justify-content:center; column-gap:20px;" >
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap">Approved Savings</button> --}}
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filter Member</button>
<button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Savings Calc</button>
<button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4">Transaction Receipt</button>
<!-- Button trigger modal -->
</div>

{{-- modal form 1 --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           @if($members->isEmpty())
           <div class="alert alert-info">No members found.
           </div>
       @else
    <form method="Get" action="{{route('contributionsavings')}}" 
    class="form-group gap-4" style="display: grid;grid-template-columns:100px 300px;gap:20px; 
    justify-content:center;align-items:center;color:white;">
    
        {{-- @method('Post') --}}
    <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">Member</label>
            <select name="name" class="form-group rounded p-2" value="{{ request('name') }}">
                <option value="">...</option>
                @foreach ($members as $index => $member)
                {{-- @foreach($members as $member) --}}
                <option>
                        {{ $member->name }}
                    </option>
                @endforeach
                {{-- @endforeach --}}
            </select>
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">Status</label><br>
            <select name="status" class="form-group rounded p-2">
                <option value="">...</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>active</option>
                    <option value="cleared" {{ request('status') == 'cleared' ? 'selected' : '' }}>cleared</option>
                  </select>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">From Date</label>
            <input type="date" name="created_at" value="{{ request('created_at') }}" class="form-group">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">To Date</label><br>
            <input type="date" name="updated_at" value="{{ request('updated_at') }}" class="form-group">
        </div>
        <div class="md:col-span-4 flex justify-end mt-2" style="display: flex; gap:20px;">
            <button type="submit" class="form-group btn btn-primary" style="padding-left:50px;padding-right:50px;">Filter</button>
           
        </div>
    </form>
    @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{route('contributionsavings')}}" class="form-group btn btn-primary" style="padding-left:50px;padding-right:50px;">
            Refresh
        </a>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}

{{-- modal form 2 --}}
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Savings Calculator</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<div class="modal-body">
    {{-- total pending savings --}}

    <form action="" method="POST" class="p-4 bg-light rounded shadow-sm mb-4">
        @csrf
    
        <div class="row g-3">
            <div class="col-md-6">
                <label>Monthly Contribution (₦)</label>
                <input type="number" name="monthly_contribution" 
                    value="" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>Interest Rate (%) per annum</label>
                <input type="number" name="interest_rate" class="form-control" step="0.01" required>
            </div>

            <div class="col-md-6">
                <label>Duration (Years)</label>
                <input type="number" name="years" class="form-control" required>
            </div>

            {{-- <div class="col-md-6">
                <label>Outstanding Loan (₦)</label>
                <input type="number" name="loan_balance" 
                    value="" class="form-control" readonly>
            </div> --}}

            <div class="col-md-6">
                <label>Total Withdrawals (₦)</label>
                <input type="number" name="withdrawals" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Penalties (₦)</label>
                <input type="number" name="penalties" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary mt-3 w-100">Calculate Savings</button>
    </form>
</div>
{{-- @if(isset($future_value)) --}}
<div class="alert alert-success mt-4">
    <h5 class="fw-bold">Results Summary</h5>
    <table class="table">
      <tr>
        <th>Projected Total Savings</th>
        <th>Total Deductions</th>
        <th>Net Savings</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>projected</td>
        <td>total ded</td>
        <td>net</td>
        <td><a href="" class="btn btn-success btn-sm" style="font-size: 10px;">Approve Savings</a></td>
      </tr>
    </table>
    {{-- <ul class="list-group">
        <li class="list-group-item">Projected Total Savings: <strong></strong></li>
        <li class="list-group-item text-danger">Total Deductions: </li>
        <li class="list-group-item bg-light">Net Savings: <strong></strong></li>
    </ul> --}}
</div>
{{-- @endif --}}
      {{-- </div> --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- end modal 2 --}}

<!-- Modal3 -->
{{-- <div class="modal fade" id="exampleModal3"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Search with Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
            <label for="">Status</label>
            <select name="" id="">
                <option value="option1">option1</option>
            </select>
            <button class="btn btn-primary btn-sm">+ Find</button>
        </form>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> --}}
{{-- end modal 3 --}}

{{-- Modal 4 --}}
<div class="modal fade" id="exampleModal4"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Receipt</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div>
{{-- end modal 4 --}}


<hr class="alert alert-warning">
{{-- Filter Section --}}

</main>
{{-- Table --}}
<div class="table-container">
    <table class="table">
        <thead class="" >
            <tr>
                <th class="">Full Name</th>
                <th class="">Email</th>
                <th class="">Total Savings(₦)</th>
                <th class="">Total Loan Requested (₦)</th>
                <th class="">Total Loan Paid (₦)</th>
                <th class="">Outstanding Loan (₦)</th>
                <th class="">Savings Status</th>
                <th class="">Date</th>
                <th class="">Recorded By</th>
                {{-- <th class=" text-center">Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @forelse ($savings as $saving) --}}
            @foreach ($members as $index => $member)
                   @php
                        $totalSavings = $member->savings->sum('amount');
                        $totalLoans = $member->loans->sum('requested_amount');

                        $totalpaid = $member->loans->sum('amount_repaid');
                        $outstandingLoan = $totalLoans - $totalpaid;
                        // $outstandingLoan = $totalLoanBorrowed - $totalRepaid;

                        // Determine status
                        $status = $member->savings->last()?->status ?? 'No savings';
                    @endphp

                <tr class="">
                    <td class="">{{ $member->name }}</td>
                     <td>{{ $member->email }}</td>
                        <td>₦{{ number_format($totalSavings, 2) }}</td>
                        <td>₦{{ number_format($totalLoans, 2) }}</td>
                        <td>₦{{ number_format($totalpaid, 2) }}</td>
                        <td>₦{{ number_format($outstandingLoan, 2) }}</td>
                        <td>
                            @if($status === 'active')
                                <span class="btn btn-success">active</span>
                            @elseif($status === 'cleared')
                                <span class="btn btn-primary">cleared</span>
                            @elseif($status === 'pending')
                                <span class="btn btn-danger">pending</span>
                            @else
                                <span class="btn btn-warning">none</span>
                            @endif
                        </td>

                    <td class="">{{ $member->created_at->format('d M, Y') }}</td>
                    <td class="">{{ $member->name }}</td>
                    <td class="">
                        {{-- <a href="" class="alert alert-success">View</a> --}}
                            <a href="{{route('admin.repay-loan', $member->id)}}"  class="btn btn-primary btn-sm">
                              Pay for Loan</a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
</table>


</div>


<div class="d-flex justify-content-center mt-3">
    {{-- {{ $members->appends(request()->query())->links() }} --}}
</div>

{{-- Pagination --}}

@endsection