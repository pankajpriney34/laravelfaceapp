<!DOCTYPE html>
<html>
<head>
    <title>User Search</title>
</head>
<body>
    <h1>Search Users</h1>
    <p><a href="{{ route('logout') }}">Logout</a></p>
    <p><a href="{{ route('friend.requests.pending')}}">Pending Requests</a></p>

    {{-- Success or info messages --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('info'))
        <p style="color: orange;">{{ session('info') }}</p>
    @endif

    {{-- Search Form --}}
    <form method="GET" action="{{ route('users.index') }}">
        <input type="text" name="query" placeholder="Search by name or email" value="{{ $query ?? '' }}">
        <button type="submit">Search</button>
    </form>

    {{-- User List --}}
    <ul>
        @forelse ($users as $user)
            <li style="margin-bottom: 10px;">
                <!-- <img src="{{ $user->avatar }}" alt="avatar" width="30" style="vertical-align: middle;"> -->
                <a href="profile/{{ $user->id }}">{{ $user->name }}</a> - ({{ $user->email }})

                {{-- Send Friend Request Button --}}
                <form method="POST" action="{{ route('friend.request', $user->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit">Send Friend Request</button>
                </form>
            </li>
        @empty
            <li>No users found.</li>
        @endforelse
    </ul>

    <p><a href="/dashboard">← Back to Dashboard</a></p>
    <p><a href="{{ route('users.index') }}"> Go to Users</a></p>
</body>
</html>
