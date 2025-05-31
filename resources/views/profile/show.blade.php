<!DOCTYPE html>
<html>
<head>
    <title>{{ $profileUser->name }}'s Profile</title>
</head>
<body>
    <p><a href="{{ route('logout') }}">Logout</a></p>
    <h1>{{ $profileUser->name }}'s Profile</h1>

    <p>Email: {{ $profileUser->email }}</p>
    <img src="{{ $profileUser->avatar }}" width="50">

    <h2>Mutual Friends</h2>
    @forelse ($mutualFriends as $friend)
        <div>
            {{ $friend->name }} ({{ $friend->email }})
        </div>
    @empty
        <p>No mutual friends.</p>
    @endforelse

    <p><a href="/dashboard">← Back to Dashboard</a></p>
    <p><a href="{{ route('users.index') }}"> Go to Users</a></p>
</body>
</html>
