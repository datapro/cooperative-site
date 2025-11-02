@include('inc.head')
@extends('layouts.app')
@section('content')

<div class="mb-6 flex justify-between items-center" style="text-align: center; display:flex;justify-content:center; gap:50px;">
    <h2 class="text-2xl font-bold text-gray-800">⚙️ System Settings & Configuration</h2>
    <a href="{{route('admin')}}" class="btn btn-warning ">Dashbaord</a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Settings Form --}}
<form method="POST" action="#"  enctype="multipart/form-data" class="form-control">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" style="text-align: center;">
        {{-- Cooperative Info --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">🏢 Cooperative Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="coop_name" value="coop_name"
                           class="form-control rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="coop_email" value="coop_email "
                           class="form-control rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Coop_Phone</label>
                    <input type="text" name="coop_phone" value="phone"
                           class="form-control rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Coop_Address</label>
                    <textarea name="coop_address" rows="2" class="form-control rounded p-2">Coop_Adress</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" name="coop_logo" class="mt-1 border border-gray-300 rounded p-2 w-full">
                    {{-- @if(!empty($settings->coop_logo)) --}}
                        <img src="" alt="Logo" class="w-24 mt-2 rounded">
                    {{-- @endif --}}
                </div>
            </div>
        </div>

        {{-- Financial Configuration --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">💰 Financial Configuration</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Default Loan Interest Rate (%)</label>
                    <input type="number" step="0.01" name="loan_interest"
                           value="'loan_interest"
                           class="form-control rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Minimum Savings Deposit (₦)</label>
                    <input type="number" step="0.01" name="min_savings"
                           value="min_savings"
                           class="form-control rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Monthly Contribution Rate (%)</label>
                    <input type="number" step="0.01" name="contribution_rate"
                           value="contribution_rate"
                           class="form-control rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Late Payment Penalty (%)</label>
                    <input type="number" step="0.01" name="penalty_rate"
                           value="penalty rate"
                           class="form-control rounded p-2">
                </div>
            </div>
        </div>
    </div>

    {{-- Notifications --}}
    <div class="bg-white shadow rounded-lg p-6 mt-8" style="text-align: center;">
        <h3 class="text-lg font-semibold text-gray-800 mb-4" >📨 Notification Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="notify_email" value="1"
                       {{-- {{ old('notify_email', $settings->notify_email ?? false) ? 'checked' : '' }} --}}
                       class="h-4 w-4 text-blue-600">
                <span>Email Notifications</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="notify_sms" value="1"
                       {{-- {{ old('notify_sms', $settings->notify_sms ?? false) ? 'checked' : '' }} --}}
                       class="h-4 w-4 text-blue-600">
                <span>SMS Notifications</span>
            </label>

            <label class="flex items-center space-x-2">
                <input type="checkbox" name="notify_push" value="1"
                       {{-- {{ old('notify_push', $settings->notify_push ?? false) ? 'checked' : '' }} --}}
                       class="h-4 w-4 text-blue-600">
                <span>Push Notifications</span>
            </label>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex justify-end mt-8">
        <button type="submit" class="form-control btn btn-primary btn-lg rounded hover:bg-green-700">
            Save Settings
        </button>
    </div>
</form>
@endsection