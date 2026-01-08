
@include('inc.head')
@extends('layouts.app')
@section('content')
<main style="text-align: center;">


<div class="flex justify-between items-center mb-6" style="display: flex; gap:20px; justify-content:center;
 align-items:center;">
    <h2 class="text-2xl font-bold text-gray-800" style="color: rgb(163, 11, 11);">👥 Member Management</h2>
    <a href="{{route('admin')}}"
       class="btn btn-secondary">
        Dashboard
    </a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Upload multiple members with excel or csv</button>
</div>
<section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bulk Upload</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
    <form action="{{ route('admin.members.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
    @csrf
    <div class="form-group">
        <label for="file" style="color: rgb(163, 11, 11);">Create Multiple Member by Uploading Excel File (.xlsx, .xls, .csv)</label><br>
        <input type="file" name="file" style="color: white; id="file" class="form-group" required>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Import Members</button>
</form>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
</section>

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

{{-- Members Table --}}
<div class="">
    <table class="table table-dark table-hover" width="100%">
        <thead class="">
            <tr>
                <th class="">Full Name</th>
                <th class="">Staff ID</th>
                <th class="">Ledger No</th>
               <th class="">SavingsBF (₦)</th>
               {{-- <th class="">loanBF (₦)</th> --}}
               {{-- <th class="">loanINT (%)</th> --}}
               <th class="">commBF (₦)</th>
                <th class="">Email</th>
                <th class="">Password</th>
                <th class="">Member State</th>
                <th class="">View</th>
                <th class="">Change State</th>
                <th class="">Remove Member</th>
                <th class="">is_Admin</th>
                <th class="">Assign Admin</th>
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
                    <td class="">{{$member->membership_no}} </td>
                    <td>{{$member->ledger_no }}</td>
                    <td>₦{{$member->savingsBF }}</td>
                    {{-- <td>₦{{$member->loanBF }}</td> --}}
                    {{-- <td>{{$member->loanINT }}</td> --}}
                    <td>₦{{$member->commBF }}</td>
                    <td class="">{{$member->email}}</td>
                    <td class="">password123</td>
                    <td>
                                        
                    @if($member->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                    </td>
                    <td class="">
                        <a href="{{ route('admin.editmember', $member->id) }}" class="btn btn-secondary">Edit</a>
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
                 <td>
                        <form action="{{ route('admin.members.destroy', $member->id) }}"
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                    </td>
                     <td class="border px-2">{{ $member->role === 'admin' ? 'Yes' : 'No' }}</td>
                    <td class="border px-2">
                        @if (auth()->id() !== $member->id)
                        <form method="POST" action="{{ route('admin.toggleAdmin', $member) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                {{ $member->role === 'admin' ? 'Revoke Admin' : 'Make Admin' }}
                            </button>
                        </form>
                        @else
                        <em>(you)</em>
                        @endif
                    </td>
                </tr>
                @endforeach
    </table>
</div>

{{-- Pagination --}}
<div class="mt-4" style="display:flex; justify-content:center;"> 
    {{-- {{ $members->links() }} --}}
 </div>
</main>

@endsection