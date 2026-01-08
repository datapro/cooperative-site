@include('inc.head')
@extends('layouts.app')
@section('content')
<main style="text-align: center">
    <h2 style="margin-bottom:20px;">Members Loan Consolidation (Detailed)</h2>
<div class="">
    <form method="GET" class="mb-3">
        <input type="text" name="name" value="{{ $search }}" placeholder="Search by member name" class="form-control w-25 d-inline-block">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin') }}" class="btn btn-secondary">Back</a>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Member Name</th>
                <th>Total Loans (₦)</th>
                <th>Total Interest (₦)</th>
                <th>Total Repaid (₦)</th>
                <th>Outstanding (₦)</th>
                {{-- <th>Excess Payment (₦)</th> --}}
                <th>Loans Details</th>
                <th>Repay Loan</th>
                <th>Account Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consolidation as $index => $member)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ number_format($member->totalLoans, 2) }}</td>
                    <td>{{ number_format($member->totalInterest, 2) }}</td>
                    <td>{{ number_format($member->totalRepaid, 2) }}</td>
                    <td>{{ number_format($member->totalOutstanding, 2) }}</td>
                    {{-- <td>{{ number_format($member->totalExcess, 2) }}</td> --}}
                    <td>
                        <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#loans-{{ $member->id }}" aria-expanded="false" aria-controls="loans-{{ $member->id }}">
                            View Loans
                        </button>
                    </td>
                    <td><a href="{{route('admin.repay-loan',$member->id)}}" class="btn btn-secondary">Repay</a></td>
                    <td><a href="{{route('admin.receipt',$member->id)}}" class="btn btn-secondary">Account Info</a></td>
                </tr>
                <tr>
                    <td colspan="8" class="p-0 border-0">
                        <div class="collapse" id="loans-{{ $member->id }}">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>#</th>
                                        <th>Requested Amount</th>
                                        <th>Interest</th>
                                        <th>Total Due</th>
                                        <th>Monthly Principal</th>
                                        <th>Monthly Interest</th>
                                        <th>Monthly Expected</th>
                                        <th>Amount Repaid</th>
                                        <th>Outstanding</th>
                                        {{-- <th>Excess</th> --}}
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->loansDetails as $lIndex => $loan)
                                        <tr>
                                            <td>{{ $lIndex + 1 }}</td>
                                            <td>{{ number_format($loan->principal, 2) }}</td>
                                            <td>{{ number_format($loan->interest, 2) }}</td>
                                            <td>{{ number_format($loan->totalDue, 2) }}</td>
                                            <td>{{ number_format($loan->monthlyPrincipal, 2) }}</td>
                                            <td>{{ number_format($loan->monthlyInterest, 2) }}</td>
                                            <td>{{ number_format($loan->monthlyExpected, 2) }}</td>
                                            <td>{{ number_format($loan->amountRepaid, 2) }}</td>
                                            <td>{{ number_format($loan->outstanding, 2) }}</td>
                                            {{-- <td>{{ number_format($loan->excess, 2) }}</td> --}}
                                            <td>
                                                @if($loan->status === 'complete')
                                                    <span class="badge bg-success">Complete</span>
                                                @else
                                                    <span class="badge bg-warning">Active</span>
                                                @endif
                                            </td>
                                            <td>{{ $loan->created_at->format('d-m-Y') }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>

@endsection
