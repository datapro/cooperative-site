@include('inc.head')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Adminitrative Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                     <img src="{{ asset('images/' . auth()->user()->passport) }}" width="200px"
                 class="w-32 h-32 rounded-full border border-gray-300 object-cover" 
                 alt="Profile Photo" style="width: 100px; border-radius:50px;"/>
                 {{ __('SUPER ADMIN USER!') }}
                    <marquee behavior="alternate" style="color:rgb(87, 4, 4);">
                        Thank you for Joining Our Cooperative!, Your sure way to achievement
                    </marquee>
                    @include('flash.messages')
                </div>

                
            </div>
        </div>
        <main style="display: grid; 
                    gap:20px;
                    align-items:center;
                    grid-template-columns:1fr 1fr;
                    margin-top:50px;">
                    
            <div class="cards"  >
                <a href="{{route('admin.members.savings')}}">
                <img src="{{asset('assets/images/membericons/dash.png')}}" />
             <p style="font-size: 16px ; color:white;">Approve Members Savings</p>   
            </a>
        
            </div>
  
            <div class="cards">
              <a href="">
                <img src="{{asset('assets/images/membericons/settings.png')}}" />
              <p style="font-size: 16px;color:white;">Chat and Notifications</p>
              </a> 
            </div>
 
        </main>
    </div>
</div>
<aside class="sidebar">
    <div class="links-m">
         <a href="{{route('admin')}}">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
       Super Admin</a>
    </div>
    <div class="links-m">
        <a href="{{route('membermanagement')}}">
        <img src="{{asset('assets/images/membericons/user.png')}}" />
        Member Management</a>
    </div>
    <div class="links-m">
        <a href="{{route('comodity')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Comodity Management</a>
    </div>
    <div class="links-m">
        <a href="{{route('admin.consolidation')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Consolidation</a>
    </div>
    <div class="links-m">
        <a href="{{route('home')}}">
        <img src="{{asset('assets/images/membericons/loans.png')}}" />
        Admin User SAVINGS</a>
    </div>
</aside>
<div style="display: flex;background-color:rgb(112, 18, 2); justify-content:center; align-items:center; flex-direction:row;">
    @auth
    @if(auth()->user()->role === 'admin')
         {{-- <div class="links">
        <a href="{{route('home')}}">
        <img src="{{asset('assets/images/membericons/dash.png')}}" />
        Dashboard
    </a>
    </div> --}}
    
        <div class="links">
            <a href="{{ route('memberloan') }}">
                <img src="{{ asset('assets/images/membericons/loans.png') }}" />
                Loans
            </a>
        </div>

        {{-- <div class="links">
            <a href="{{ route('membercontributions') }}">
                <img src="{{ asset('assets/images/membericons/business.png') }}" />
                Savings Report
            </a>
        </div> --}}

        <div class="links">
            <a href="{{ route('commodity_request') }}">
                <img src="{{ asset('assets/images/membericons/business.png') }}" />
                Commodity Request
            </a>
        </div>

        <div class="links">
            <a href="{{ route('profile') }}">
                <img src="{{ asset('assets/images/membericons/profile.png') }}" />
                Profile
            </a>
        </div>

    @endif
@endauth
    </div>
<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('admin') }}">
                              <input type="text" name="query" placeholder="Search member" value="{{ $search }}">
                              <button type="submit" class="btn btn-primary">Search</button>
                          </form><br>
                        <h4n style="margin-bottom: 0;">Member Users List</h4>
                        <table class="table table-dark table-striped mt-3">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>links</th>
                              <th>Email</th>
                              <th>Role</th>
                        
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ route('admin.users.dashboard', $user->id) }}" style="color:aqua;">
                                        {{ $user->name }}  >> View Dashboard
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>

                        {{-- Pagination links --}}
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


@endsection
