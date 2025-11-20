@include('inc.head')
@extends('layouts.app')

@section('content')
<div style="display: flex; column-gap:50px; justify-content:center;align-items:center;">
    <h1>Approve Member Pending Savings</h1>
    <a class="btn btn-primary" href="{{route('admin')}}" style="text-align: left;">
        Back
    </a>
</div>
<div>
         <form class="" action="{{ route('search.savings') }}" method="GET">
                @csrf
            <label class="block text-gray-700 text-sm font-semibold mb-1">Member Name</label>
              <select name="query" class="form-group" required>
              <option value="">-- Select Member --</option>
              @foreach ($members as $member)
                  <option name="query"  value="{{ $member->name }}">{{ $member->name }}</option>
              @endforeach
          </select>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{route('search.savings')}}" class="btn btn-secondary">Refresh</a>
          </form><br>
</div>
<div class="table-container">   
    <table class="table">
    <thead>
        <tr>
            <th>Member Name</th>
            <th>Approved Savings (₦)</th>
            <th>Pending Savings (₦)</th>
            {{-- <th>Total Savings (₦)</th> --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>₦{{ number_format($member->totalApproved, 2) }}</td>
            <td>₦{{ number_format($member->totalPending, 2) }}</td>
            {{-- <td><strong>₦{{ number_format($member->total_savings, 2) }}</strong></td> --}}
            <td>
                @if($member->totalPending > 0)
                    <form action="{{ route('admin.members.approveSavings', $member->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background:rgb(163, 11, 11); color:white;">
                            Approve Pending Savings
                        </button>
                    </form>
                @else
                    <span class="text-muted">No Pending Savings</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="mt-4" style="display:flex; justify-content:center;"> 
    {{ $members->links() }}
 </div>
   @php
        $total_savings = $members->sum('totalApproved');
    @endphp
    <div style="display: flex;justify-content:center;align-items:center; background: rgb(163, 11, 11);color:white;">
            <h6>COOPERATIVE TOTAL MEMBER APPROVED DEPOSIT = </h6>
        <h4> ₦{{ number_format($total_savings, 2) }}</h4>
    </div>
</div>
@endsection

