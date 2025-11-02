
@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6" style="text-align: center;">
    <h2 class="text-2xl font-bold text-gray-800" style="color: white;">🏦 Accounts & Transactions</h2>
    <a href="#"
       class="btn btn-secondary btn-sm rounded hover:bg-green-700">
       + Record Transaction
    </a>
    <a href="{{route('admin')}}"
       class="btn btn-secondary btn-sm rounded hover:bg-green-700">
       + Dashbaord
    </a>
</div>

<div style="display: flex;justify-content:center; column-gap:20px; margin-top:30px;" >
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap">
  +  Approved | Rejected Loan
</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Filter Member
</button>
<button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
    + Loan Calculator
</button>
<!-- Button trigger modal -->
</div>
{{-- modal form 1 --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           {{-- @if($members->isEmpty()) --}}
           <div class="alert alert-info">No members found.
             <a href="{{route('loanManagement')}}" class="form-group btn btn-primary" style="padding-left:50px;padding-right:50px;">Refresh</a>
           </div>
       {{-- @else --}}
    <form method="Get" action="{{route('contributionsavings')}}" 
    class="form-group gap-4" style="display: grid;grid-template-columns:100px 300px;gap:20px; 
    justify-content:center;align-items:center;color:white;">
    
        {{-- @method('Post') --}}
    <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">Member</label>
            <select name="" class="form-group rounded p-2">
                <option value="">...</option>
                {{-- @foreach ($members as $index => $member) --}}
                {{-- @foreach($members as $member) --}}
                <option>
                        {{-- {{ $member->name }} --}}
                    </option>
                {{-- @endforeach --}}
                {{-- @endforeach --}}
            </select>
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">Status</label><br>
            <select name="status" class="form-group rounded p-2">
                <option value="">...</option>
                    <option value="Pending Request" {{ request('status') == 'Pending Request' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="cleared" {{ request('status') == 'cleared' ? 'selected' : '' }}>Cleared</option>
            </select>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">From Date</label>
            <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-group">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-1">To Date</label><br>
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-group">
        </div>
        <div class="md:col-span-4 flex justify-end mt-2" style="display: flex; gap:20px;">
            <button type="submit" class="form-group btn btn-primary" style="padding-left:50px;padding-right:50px;">Filter</button>
           
        </div>
    </form>
    {{-- @endif --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}

{{-- modal form 2 --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Savings Calculator</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- end modal 2 --}}

<!-- Modal3 -->
<div class="modal fade" id="exampleModal3"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Search with Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
            <label for="">Status</label>
            <select name="" id="">
                <option value="option1">option1</option>
            </select>
            <button class="btn btn-primary btn-sm">+ Find</button>
        </form>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- end modal 3 --}}

<hr class="alert alert-warning">

{{-- Accounts Table --}}
<div class="bg-white shadow rounded-lg ">
    <table class="table  text-center">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border-b">#</th>
                <th class="p-3 border-b">Member</th>
                <th class="p-3 border-b">Account No</th>
                <th class="p-3 border-b">Type</th>
                <th class="p-3 border-b">Amount (₦)</th>
                <th class="p-3 border-b">Balance (₦)</th>
                <th class="p-3 border-b">Date</th>
                <th class="p-3 border-b text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse ($transactions as $transaction) --}}
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-b">iteration</td>
                    <td class="p-3 border-b">name</td>
                    <td class="p-3 border-b">account number</td>
                    <td class="p-3 border-b capitalize">
                        {{-- @switch($transaction->type)
                            @case('deposit') --}}
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Deposit</span>
                                {{-- @break
                            @case('withdrawal') --}}
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">Withdrawal</span>
                                {{-- @break
                            @case('loan') --}}
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">Loan</span>
                                {{-- @break
                            @case('repayment') --}}
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">Repayment</span>
                                {{-- @break
                        @endswitch --}}
                    </td>
                    <td class="p-3 border-b font-semibold text-gray-700">₦(amount)</td>
                    <td class="p-3 border-b font-semibold text-green-700">₦(balaance)</td>
                    <td class="p-3 border-b">Date</td>
                    <td class="p-3 border-b text-center space-x-2">
                        <a href="#" class="alert alert-success ">View</a>
                        <a href="#" class="alert alert-primary">Edit</a>
                    </td>
                </tr>
            {{-- @empty --}}
                <tr>
                    <td colspan="8" class="p-4 text-gray-500 text-center">No transactions found.</td>
                </tr>
            {{-- @endforelse --}}
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-4">
    {{-- {{ $transactions->links() }} --}}
</div>
@endsection