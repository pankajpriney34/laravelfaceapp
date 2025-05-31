<!DOCTYPE html>
<html>
<head>
    <title>Pending Friend Requests</title>
</head>
<body>

    <p><a href="{{ route('logout') }}">Logout</a></p>

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

    <h1>Pending Friend Requests</h1>

    @forelse ($pendingRequests as $request)
        <div>
            {{ $request->sender->name }} - ({{ $request->sender->email }})
            <form method="POST" action="{{ route('friend.request.accept', $request->id) }}" style="display:inline;">
                @csrf
                <button type="submit">Accept</button>
            </form>
        </div>
    @empty
        <p>No Pending Requests.</p>
    @endforelse

    <p><a href="/dashboard">← Back to Dashboard</a></p>
    <p><a href="{{ route('users.index') }}"> Go to Users</a></p>
</body>
</html>
