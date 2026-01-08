@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="mb-6 flex justify-between items-center" style="justify-content:center; display:flex; gap:50px;align-items:center;">
    <h2 class="text-2xl font-bold text-gray-800" style="color: white;">👤 Member Profile</h2>

    <a href="{{route('memberdashboard', $user->id)}}" class="btn btn-secondary">
        ← Back to Members
    </a>
</div>
@include('flash.messages')
<div class="bg-white shadow-lg rounded-lg p-6" style="display: grid; grid-template-columns:1fr ; justify-content:center;">
    <div class="" style="text-align: center;display:grid;grid-template-columns:300px 300px;">
        {{-- Left: Profile Picture --}}
        <div class="col-span-1 flex flex-col items-center">
            <img src="{{ asset('images/' . $user->passport) }}" width="200px"
                 class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                 alt="Profile Photo" style="width: 100px; border-radius:50px;">

            <h3 class="mt-4 text-xl font-semibold text-gray-800">{{$user->name}}</h3>
            <p class="text-gray-500 text-sm">{{$user->membership_no}}</p>
            <p class="text-green-700 font-semibold mt-1">
                {{$user->status}}
            </p>
            <div>
                    <a href="{{route('member.memberedit' , $user->id )}}" class="btn btn-danger">Update User</a>
                </div>
        </div>
        {{-- Right: Member Info --}}
        <div class="col-span-2 space-y-4" >
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="text-align: center;display:grid;grid-template-columns:1fr;">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Email</label>
                    <p class="text-gray-800">{{$user->email}}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Phone</label>
                    <p class="text-gray-800">{{$user->phone}}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Date Joined</label>
                    <p class="text-gray-800">{{$user->created_at}}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Department</label>
                    <p class="text-gray-800">{{$user->department}}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Occupation</label>
                    <p class="text-gray-800">{{$user->occupation}}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Address</label>
                    <p class="text-gray-800">{{$user->address}}</p>
                </div>
               
            </div>
        </div>
    </div>

    {{-- Financial Summary --}}
    <div class="cards">
        <h3 class="" style="color:white;">💰 Financial Summary</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4" style="text-align: center;display:grid;grid-template-columns:1fr 1fr;">
            <div class="bg-blue-50 p-4 rounded text-center shadow">
                <p class="text-sm text-gray-500">Total Savings</p>
                <p class="text-xl font-bold text-blue-700">₦{{ number_format($total, 2) }}</p>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">📜 Recent Transactions</h3>
    </div>
</div>


@endsection