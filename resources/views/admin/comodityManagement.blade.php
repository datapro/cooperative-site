@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6" style="text-align:center;color:rgb(184, 31, 20)">
    <h2 class="text-2xl font-bold text-gray-800">💵 Comodity Management</h2>
    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    + Pay for Commodity
    </button>
    <a href="{{route('admin')}}"
    class="btn btn-success">
    + Dashbaord
</a>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pay For Commodity</h1>
      </div>
      <div class="modal-body">                  
              <form class="" action="{{ route('search') }}" method="GET">
                @csrf
            <label class="block text-gray-700 text-sm font-semibold mb-1">Member Name</label>
              <select name="query" class="form-control" required>
              <option value="">-- Select Member --</option>
              @foreach ($users as $user)
                  <option value="{{ $user->name }}">{{ $user->name }}</option>
              @endforeach
          </select>
            <button type="submit" class="btn btn-primary">Filter</button>
          </form><br>

       <form action="{{route('comodity.pay',$user->id)}} " method="POST">
    @csrf
    <div class="form-control">
      <label>Enter Payment Amount:</label>
      <input type="number" name="payment_amount" class="form-control" placeholder="Enter amount" required>
    </div>

    <button type="submit" class="btn btn-primary form-control">Pay</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="form-group btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <a href="{{route('comodity')}}" class="form-group btn btn-primary">Refresh</a>
      </div>
    </div>
  </div>
</div>
{{-- end modal0 --}}

{{-- Comoditys Table --}}
<div class=" ">
  @include('flash.messages')
<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>Member</th>
            <th>Total Pending Commodity</th>
            <th>Total Approved Commodity</th>
            <th>Total Paid</th>
            <th>Outstanding Balance</th>
            <th>Action</th>
            <th>Report</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user['name'] }}</td>
            <td>₦{{ number_format($user['pending_total'], 2) }}</td>
            <td>₦{{ number_format($user['approved_total'], 2) }}</td>
            <td>₦{{ number_format($user['total_paid'], 2) }}</td>
            <td>₦{{ number_format($user['balance'], 2) }}</td>
              {{-- Check if balance remains --}}
            <td>
              <form action="{{ route('admin.comodity', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary ">
                    Approve
                </button>
            </form>
            </td> <!-- Approved total -->
            <td><a href="{{ route('commodity.admin.report', $user->id) }}" class="btn btn-success">Report</a></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Grand Total</th>
            <th>₦{{ number_format($grandPending, 2) }}</th>
            <th>₦{{ number_format($grandApproved, 2) }}</th>
            <th>₦{{ number_format($grandPaid, 2) }}</th>
            <th>₦{{ number_format($grandBalance, 2) }}</th>
        </tr>
    </tfoot>
</table>


</div>



{{-- Pagination --}}
<div class="mt-4">
    {{-- {{ $Comoditys->links() }} --}}
</div>


@endsection