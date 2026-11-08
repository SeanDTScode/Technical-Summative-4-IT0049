@extends('layouts.tasks')

@section('title', 'Profile')

@section('content')
    <h1>Profile</h1>

    @if ($user)
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Full Name:</strong> {{ $user->full_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    @else
        <p>No user profile was found.</p>
    @endif
@endsection