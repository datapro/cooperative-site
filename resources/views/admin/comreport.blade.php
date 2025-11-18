@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="container">
<div style="display: flex;column-gap:20px;align-items:center;">
    <h3 class="mb-3">Commodity Request Report for: <strong>{{ $user->name }}</strong></h3>
    <a href="{{route('comodity')}}" class="btn btn-secondary ">BAcK</a>

</div>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Pending Total:</strong> ₦{{ number_format($pendingTotal, 2) }}</p>
            <p><strong>Approved Total:</strong> ₦{{ number_format($approvedTotal, 2) }}</p>
            <p><strong>Interest (6%):</strong> ₦{{ number_format($interest, 2) }}</p>
            <p><strong>Total Amount Due:</strong> ₦{{ number_format($amountDue, 2) }}</p>
            <p><strong>Total Paid:</strong> ₦{{ number_format($totalPaid, 2) }}</p>

            <h5>
                <strong>Balance:</strong> 
                @if($balance > 0)
                    <span class="text-danger">₦{{ number_format($balance, 2) }} (Owing)</span>
                @else
                    <span class="text-success">₦0.00 (Completed)</span>
                @endif
            </h5>
        </div>
    </div>

    <h4>Request Breakdown</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Price (₦)</th>
                <th>Payment (₦)</th>
                <th>Status</th>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($user->commodityRequests as $key => $req)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $req->item ?? 'N/A' }}</td>
                    <td>₦{{ number_format($req->price, 2) }}</td>
                    <td>₦{{ number_format($req->payment_amount ?? 0, 2) }}</td>
                    <td>
                        @if($req->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($req->status == 'approved')
                            <span class="badge bg-primary">Approved</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>{{ $req->note ?? '---' }}</td>
                    <td>{{ $req->created_at->format('d M, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



