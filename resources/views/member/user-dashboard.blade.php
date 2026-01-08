{{-- resources/views/admin/user-dashboard.blade.php --}}
@include('inc.head')
@extends('layouts.app')

@section('content')
<h3>{{ $user->name }}'s Dashboard</h3>

<div class="alert alert-info">
    You are viewing this dashboard as <strong>Admin</strong>
</div>

<p>Email: {{ $user->email }}</p>
<p>Joined: {{ $user->created_at->format('d M Y') }}</p>

{{-- include same widgets user sees --}}
{{-- @include('user.partials.stats', ['user' => $user]) --}}

@endsection
