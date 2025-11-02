@include('inc.head')
@extends('layouts.app')
@section('content')

<main style="display: flex;justify-content:center; gap:20px">
    <div class="">
    
    <img src="{{ asset('images/' . $user->passport) }}" style="width:100px;height:100px" name="passport" alt="user" /><br>
    <label for="" style="color: white;">Member profile Picture:</label>
</div>

<form class="" action="{{ route('member.memberupdate', $user->id)}}" method="POST" enctype="multipart/form-data" style="display:grid;grid-template-columns:1fr;gap:10px; " >
        @csrf
        @method('PUT')

        <div class="">
            <label for="">Name:</label>
            <input type="text" value="{{$user->name}}" style="width:400px;" name="name" >
            <span class="login-page__form__icon">
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Occupation:</label>
            <input type="text" value="{{$user->occupation}}" style="width:400px;" name="occupation" >
            <span class="login-page__form__icon">
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Phone:</label>
            <input type="text" style="width:400px;" value="{{$user->phone}}" name="phone">
            <span class="login-page__form__icon">
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Department:</label>
            <input style="width:400px;" type="text"  value="{{$user->department}}" name="department">
            <span class="login-page__form__icon">
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="" style="vertical-align: top;">Address:</label>
            <textarea style="width:400px;" cols="60" rows="3" name="address" >
                {{$user->address}}
            </textarea>
        </div><!-- /. -->
        <div class="">
            <label for="">Member ID:</label>
            <input style="width:400px;" type="text" value="{{$user->membership_no}}" disabled name="membership_no">
            <span class="login-page__form__icon">
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Status:</label>
            <input type="text" name="status" value="{{$user->status}}" disabled>
            {{-- <option value="Inactive">In-Active</option> --}}
            <!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Active Mail:</label>
            <input type="email" value="{{$user->email}}" name="email">
            <span class="login-page__form__icon">
                <i style="width:400px;" class="icon-mail-2"></i>
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div class="">
            <label for="">Password:</label>
            <input style="width:400px;" type="text" value="{{$user->password}}"  class="login-page__password" name="password">
            <span class="login-page__form__icon">
                <i style="width:400px;" class="icon-padlock"></i>
            </span><!-- /.login-page__form__icon -->
        </div><!-- /. -->
        <div>
            <div class="login-page__form__checked-box" style="color: white;">
                <label for="" style="color: white;">Change Profile Picture:</label>
                <input style="width:400px;" type="file" name="passport" id="accept-policy">
            </div>
            <button type="submit" class="btn btn-primary">
                <span>Update Membership</span>
            </button>
            <a  class="btn btn-secondary btn-lg" style="padding-left: 20px;" href="{{route('profile')}}">Cancel</a>
        </div>
</form><!-- /.login-page__form -->
</main>

@endsection