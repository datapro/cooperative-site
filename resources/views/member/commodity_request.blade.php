@include('inc.head')
@extends('layouts.app')
@section('content')
<aside class="sidebar">
    <div class="links">
        <a href="{{route('home')}}">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        Dashboard
    </a>
    </div>
    <div class="links">
        <a href="{{route('member.showsavings')}}">
        <img src="{{asset('assets/images/membericons/savings.png')}}" />
        Savings
    </a>
    </div>
    <div class="links">
        <a href="{{route('memberloan')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Loans
    </a>
    </div>
    <div class="links">
        <a href="{{route('membercontributions')}}">
        <img src="{{asset('assets/images/membericons/business.png')}}" />
        Savings Report
    </a>
    </div>
    <div class="links">
        <a href="{{route('commodity_request')}}">
        <img src="{{asset('assets/images/membericons/business.png')}}" />
        Commodity Request
    </a>
    </div>
    <div class="links">
        <a href="{{route('profile')}}">
        <img src="{{asset('assets/images/membericons/profile.png')}}" />
       Profile
    </a>

    </div>
</aside>

<main class="commodity">
    <div>
        
        <form action="{{ route('member.commodity_request') }}" class="form-control" method="POST">
            @csrf
            @include('flash.messages')
               <div class="mb-3">
              <label for="" class="form-label" style="font-weight: bold;">Product Cost(₦):</label>
              <input type="number" name="price" class="form-control" step="2" required>
            </div>
            <div class="mb-3">
              <label for="" class="" class="form-control" style="font-weight: bold;">Payment Plan:</label>
              <select name="payment_plan" id="" class="form-control" required>
                <option  name="payment_plan" value="at ones">at ones</option>
                <option name="payment_plan" value="2 months">2 months</option>
                <option name="payment_plan" value="4 months">4 months</option>
                <option name="payment_plan" value="6 months">6 months</option>
                <option name="payment_plan" value="8 months">8 months</option>
                <option name="payment_plan" value="10 months">10 months</option>
                <option name="payment_plan" value="12 months">12 months</option>
                {{-- <option value="Deduct form Savings">Deduct form Savings</option> --}}
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="" class="form-control" style="font-weight: bold;">Payment_option:</label>
              <select name="payment_option" id="" class="form-control" required>
                <option name="payment_option" value="Cash">Cash</option>
                <option name="payment_option" value="Deduction from Savings">Deduction from Savings</option>
                {{-- <option value="Deduct form Savings">Deduct form Savings</option> --}}
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label" style="font-weight: bold;"> Decription of Item:</label>
              <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('home')}}" class="btn btn-secondary">Back</a>
        </form>

    </div>

    <div>
        <h3>Cooperator Commodity Requests History</h3>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>StaffID</th>
                    <th>Cost (₦)</th>
                    <th>Status</th>
                    <th>Payment Option</th>
                    <th>Payment Plan</th>
                    <th>Payment with 6% interest</th>
                    <th>Decription of Item</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commodities as $commodity)
                <tr>
                    <td>{{$commodity->user->membership_no}}</td>
                    <td>₦{{$commodity->price}}</td>
                    <td>{{$commodity->status}}</td>
                    <td>{{$commodity->payment_option}}</td>
                    <td>{{$commodity->payment_plan}}</td>
                    <td>{{$commodity->payment_amount}}</td>
                    <td>{{$commodity->note}}</td>
                    <td>{{$commodity->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4" style="display:flex; justify-content:center;"> 
            {{ $commodities->links() }}
         </div>
    </div>
{{-- Pagination --}}
</main>

@endsection