@include('inc.head')
@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold mb-2">Savings & Contributions</h2>
    <p class="text-gray-600">Overview of all members’ savings and contributions records.</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-gray-500 text-sm">Total Savings</h3>
        <p class="text-2xl font-bold text-green-700">₦{{ number_format($totalSavings ?? 0, 2) }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-gray-500 text-sm">Total Contributions</h3>
        <p class="text-2xl font-bold text-blue-700">₦{{ number_format($totalContributions ?? 0, 2) }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-gray-500 text-sm">Active Members</h3>
        <p class="text-2xl font-bold text-gray-800">{{ $activeMembers ?? 0 }}</p>
    </div>
</div>

{{-- Savings Records Table --}}
<div class="bg-white shadow rounded p-6 mb-6">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-semibold">Member Savings Records</h3>
        <a href="{{ route('admin.savings.create') }}" class="bg-green-700 text-white px-3 py-2 rounded hover:bg-green-800">
            + Add New Record
        </a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="py-2 px-3">Member</th>
                <th class="py-2 px-3">Amount (₦)</th>
                <th class="py-2 px-3">Type</th>
                <th class="py-2 px-3">Date</th>
                <th class="py-2 px-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($savings as $record)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-3">{{ $record->member->name }}</td>
                <td class="py-2 px-3">{{ number_format($record->amount, 2) }}</td>
                <td class="py-2 px-3 capitalize">{{ $record->type }}</td>
                <td class="py-2 px-3">{{ $record->date->format('d M Y') }}</td>
                <td class="py-2 px-3 text-right">
                    <a href="{{ route('admin.savings.edit', $record->id) }}" class="text-blue-600 mr-2">Edit</a>
                    <form action="{{ route('admin.savings.destroy', $record->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">No savings records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Contributions Table --}}
<div class="bg-white shadow rounded p-6">
    <h3 class="text-lg font-semibold mb-4">Member Contributions</h3>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="py-2 px-3">Member</th>
                <th class="py-2 px-3">Contribution (₦)</th>
                <th class="py-2 px-3">Month</th>
                <th class="py-2 px-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contributions as $c)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-3">{{ $c->member->name }}</td>
                <td class="py-2 px-3">{{ number_format($c->amount, 2) }}</td>
                <td class="py-2 px-3">{{ $c->month }}</td>
                <td class="py-2 px-3">
                    <span class="px-2 py-1 text-sm rounded {{ $c->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($c->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4 text-gray-500">No contributions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

