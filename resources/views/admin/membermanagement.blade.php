
@include('inc.head')
@extends('layouts.app')
@section('content')
<main style="text-align: center;">


<div class="flex justify-between items-center mb-6" style="display: flex; gap:20px; justify-content:center;
 align-items:center;">
    <h2 class="text-2xl font-bold text-gray-800" style="color: white;">👥 Member Management</h2>
    <a href="{{route('admin')}}"
       class="btn btn-secondary btn-sm">
        Dashboard
    </a>
</div>
@include('flash.messages')
{{-- Search Bar --}}
<div class="mb-4">
     @if($members->isEmpty())
           <div class="alert alert-info">No members found.</div>
       @else
    <form method="GET" action="{{route('membermanagement')}}" class="flex">
       <select name="name" class="form-group rounded p-2">
                <option value="{{ request('name') }}">...</option>
                @foreach ($members as $index => $member)
                {{-- @foreach($members as $member) --}}
                <option>
                        {{ $member->name }}
                    </option>
                @endforeach
                {{-- @endforeach --}}
            </select>
        <button type="submit" class="btn btn-primary btn-sm">
            Search
        </button>
        <a href="{{route('membermanagement')}}" class="btn btn-warning btn-sm">
            Refresh
        </a>
    </form>
    @endif
</div>
<div>
    <form action="{{ route('admin.members.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
    @csrf
    <div class="form-group">
        <label for="file" style="color: white;">Create Multiple Member by Uploading Excel File (.xlsx, .xls, .csv)</label><br>
        <input type="file" name="file" style="color: white; id="file" class="form-group" required>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Import Members</button>
</form>
</div>
{{-- Members Table --}}
<div class="">
       {{-- <form action="" style="display: inline-block"
                              method="POST" class="inline-block">
                            @csrf
                           
                            <button type="submit" class="btn btn-success" >Register Bulk Memeber with Excel Sheet</button>
                        </form> --}}
    <table class="table" width="100%">
        <thead class="">
            <tr>
                <th class="">Full Name</th>
                <th class="">Email</th>
                <th class="">Phone</th>
                <th class="">Membership ID</th>
               <th class="">Total Savings (₦)</th>
                <th class="">Total Loan Borrowed (₦)</th>
                <th class="">Outstanding Loan (₦)</th>
                <th class="">Loan Status</th>
                <th class="">Status</th>
                <th class="">Change Status</th>
                {{-- <th class=""></th> --}}
                <th class="">View</th>
                <th class="">Remove Member</th>
            </tr>
        </thead>
           @foreach ($members as $index => $member)
                   @php
                        $totalSavings = $member->savings->sum('amount');
                        $totalLoanBorrowed = $member->loans->sum('amount_borrowed');
                        $totalRepaid = $member->loans->sum('amount_repaid');
                        $outstandingLoan = $totalLoanBorrowed - $totalRepaid;

                        // Determine status
                        $status = $member->loans->last()?->status ?? 'No Loan';
                    @endphp
              <tr class="">
                    <td class="">{{$member->name}} </td>
                    <td class="">{{$member->email}}</td>
                    <td class="">{{$member->phone}} </td>
                    <td class="">{{$member->membership_no}} </td>
                     <td>₦{{ number_format($totalSavings, 2) }}</td>
                        <td>₦{{ number_format($totalLoanBorrowed, 2) }}</td>
                        <td>₦{{ number_format($outstandingLoan, 2) }}</td>

                        <td>
                            @if($status === 'active')
                                <span class="badge bg-warning text-dark">Active</span>
                            @elseif($status === 'cleared')
                                <span class="badge bg-success">Cleared</span>
                            @elseif($status === 'Pending Request')
                                <span class="badge bg-info text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">None</span>
                            @endif
                        </td>
                    <td class="" style="display: flex">
                                        
                    @if($member->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                    </td>
                    <td>
                         <form action="{{ route('admin.members.toggleStatus', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($member->status === 'active')
                                <button type="submit" class="btn btn-sm btn-warning">Deactivate</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-success">Activate</button>
                            @endif
                        </form>
                    </td>
                    <td class="">
                        <a href="{{ route('admin.editmember', $member->id) }}" class="alert alert-success">Edit</a>
                    </td>
                    {{-- <td>
                        <a href="#" class="alert alert-primary">View</a>
                    </td> --}}
                    <td>
                        <form action="{{ route('admin.members.destroy', $member->id) }}"
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
    </table>
</div>

{{-- Pagination --}}
{{-- <div class="mt-4"> --}}
    {{-- {{ $members->links() }} --}}
{{-- </div> --}}
</main>

@endsection