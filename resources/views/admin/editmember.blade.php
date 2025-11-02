@include('inc.head')
@extends('layouts.app')
@section('content')
<div class="container mt-4" style="color: white;">
    <h4>Edit Member Information</h4>

    <form action="{{route('admin.member', $member->id)}}" method="POST">
        @csrf
        @method('PUT')
<div class="row g-3">
    <div class="col-md-4">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name"  value="{{ old('name', $member->name) }}" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label for="name" class="form-label">Member ID</label>
        <input type="text" name="membership_no"  value="{{ old('membership_no', $member->membership_no) }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label for="name" class="form-label">Department</label>
        <input type="text" name="department"  value="{{ old('department', $member->department) }}" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label for="name" class="form-label">Password</label>
        <input type="text" name="password"  value="{{ old('password', $member->password) }}" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone) }}" class="form-control">
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

</div>
<div style="margin-top: 20px;">
    <button type="submit" class="btn btn-primary">Update Member</button>
    <a href="{{ route('membermanagement') }}" class="btn btn-secondary">Cancel</a>

</div>
    </form>
</div>

@endsection