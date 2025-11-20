@include('inc.head')
@extends('layouts.app')
@section('content')

<main style="text-align: center">
<div  style="display: flex; justify-content:center; column-gap:20px;align-items:center;">
     <img src="{{ asset('images/' . auth()->user()->passport) }}" width="200px"
                 class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                 alt="Profile Photo" style="width: 100px; border-radius:50px;"/>

        <h2 class="text-2xl font-bold text-gray-800" style="color: rgb(163, 11, 11);">
                     💰 Reports
            </h2>
                    <a href="{{route('admin')}}" class="btn btn-secondary"> + Dashboard</a>
       
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap">Approved Savings</button> --}}
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filter Member</button>

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
                    <option value="none" {{ request('status') == 'none' ? 'selected' : '' }}>none</option>
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
</div>
{{-- @endif --}}
      {{-- </div> --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</main>
{{-- Table --}}
<div class="table-container">
    <table class="table table-dark table-hover">
        <thead class="">
            <tr>
                <th class="">MemberShip ID</th>
                <th class="">Full Name</th>
                <th class="">Email</th>
                <th class="">Total Savings(₦)</th>
                <th class="">Savings Status</th>
                <th class="">Total Loan Requested (₦)</th>
                <th class="">Total Loan Paid (₦)</th>
                <th class="">Outstanding Loan (₦ Previous)</th>
                <th class="">Loan Status (latest loan)</th>
                <th class="">Date</th>
                <th class="">Recorded By</th>
                <th class="">Action</th>
                <th class="">Transaction Receipt</th>
            </tr>
        </thead>
              <tbody>
      @foreach ($members as $index => $member)
         @php
        $status = $member->savings->last()?->status ?? 'No savings'; 
    @endphp 

    <tr>
        <td>{{ $member->membership_no }}</td>
        <td>{{ $member->name }}</td>
        <td>{{ $member->email }}</td>
        <td>₦{{ number_format($member->totalApprovedSavings, 2) }}</td>
        <td>{{$status}}</td>
        <td>₦{{ number_format($member->totalLoans, 2) }}</td>
        <td>₦{{ number_format($member->totalRepaid, 2) }}</td>
        <td>₦{{ number_format($member->total_outstanding, 2) }}</td>

        <td>{{ optional($member->loans->last())->status ?? 'No Loan' }}</td>
      
        <td>{{ $member->created_at->format('d M, Y') }}</td>
        <td>{{ $member->name }}</td>

        <td>
            <a href="{{ route('admin.repay-loan', $member->id) }}" 
              style="font-size: 14px;font-weight:bold;" class="btn btn-secondary btn-sm">
                Loan Repayment
            </a>
        </td>
        <td>
            <a href="{{ route('admin.receipt', $member->id) }}" 
              style="font-size: 14px;font-weight:bold;" class="btn btn-primary btn-lg">
                Receipt
            </a>
        </td>

    </tr>
@endforeach
</tbody>

</table>


</div>


<div class="mt-4" style="display:flex; justify-content:center;"> 
    {{ $members->links() }}
 </div>

{{-- Pagination --}}

@endsection