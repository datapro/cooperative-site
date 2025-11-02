@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="mb-6 flex justify-between items-center" style="text-align: center;display:grid;grid-template-columns:1fr 1fr;">
    <h2 class="text-2xl font-bold text-gray-800">📊 Reports & Analytics</h2>
    <form method="GET" action="#" class="flex space-x-2">
        <input type="month" name="month" value="date"
               class="border border-gray-300 rounded p-2">
        <button class="btn btn-primary btn-lg rounded hover:bg-blue-700">Filter</button>
        <a href="{{route('admin')}}" class="btn btn-secondary">Dashboard</a>
    </form>
</div>

{{-- Summary Stats --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" style="display:grid;grid-template-columns:1fr 1fr; gap:20px;">
    <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-gray-600">Total Members</p>
        <h3 class="text-2xl font-bold text-gray-800">total members</h3>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-gray-600">Total Savings (₦)</p>
        <h3 class="text-2xl font-bold text-green-700">₦(total savings)</h3>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-gray-600">Total Loans (₦)</p>
        <h3 class="text-2xl font-bold text-yellow-600">₦(totalLoans)</h3>
    </div>
    <div class="bg-white shadow rounded-lg p-4 text-center">
        <p class="text-gray-600">Total Contributions (₦)</p>
        <h3 class="text-2xl font-bold text-blue-700">₦(contribution)</h3>
    </div>
</div>

{{-- Chart Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8" style="display:grid;grid-template-columns:1fr 1fr; gap:20px;">
    {{-- Monthly Transactions --}}
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 mb-3 text-lg">📈 Monthly Transaction Overview</h3>
        <canvas id="transactionChart" height="100"></canvas>
    </div>

    {{-- Loan Performance --}}
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 mb-3 text-lg">💵 Loan Performance</h3>
        <canvas id="loanChart" height="100"></canvas>
    </div>
</div>

{{-- Table Section --}}
<div class="bg-white shadow rounded-lg overflow-hidden" style="display:grid;grid-template-columns:1fr; gap:20px;">
    <div class="p-4 border-b">
        <h3 class="text-lg font-semibold text-gray-800">Recent Transactions</h3>
    </div>
    <table class="min-w-full text-center">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border-b">#</th>
                <th class="p-3 border-b">Member</th>
                <th class="p-3 border-b">Type</th>
                <th class="p-3 border-b">Amount (₦)</th>
                <th class="p-3 border-b">Date</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse ($recentTransactions as $transaction) --}}
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-b">iteration</td>
                    <td class="p-3 border-b">name</td>
                    <td class="p-3 border-b capitalize">type</td>
                    <td class="p-3 border-b font-semibold text-gray-700">₦(amount)</td>
                    <td class="p-3 border-b">date</td>
                </tr>
            {{-- @empty --}}
                <tr>
                    <td colspan="5" class="p-4 text-gray-500 text-center">No recent transactions.</td>
                </tr>
            {{-- @endforelse --}}
        </tbody>
    </table>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script>
    const ctx1 = document.getElementById('transactionChart');
    const transactionChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            // labels: {!! json_encode() !!},
            datasets: [
                {
                    label: 'Deposits',
                    data: {!! json_encode($monthlyDeposits) !!},
                    backgroundColor: 'rgba(34,197,94,0.6)', // green
                },
                {
                    label: 'Withdrawals',
                    data: {!! json_encode($monthlyWithdrawals) !!},
                    backgroundColor: 'rgba(239,68,68,0.6)', // red
                }
            ]
        }
    });

    const ctx2 = document.getElementById('loanChart');
    const loanChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Repaid'],
            datasets: [{
                data: [
                    {{ $approvedLoans }},
                    {{ $pendingLoans }},
                    {{ $repaidLoans }}
                ],
                backgroundColor: [
                    'rgba(34,197,94,0.7)',
                    'rgba(234,179,8,0.7)',
                    'rgba(59,130,246,0.7)',
                ]
            }]
        }
    });
</script> --}}
@endsection