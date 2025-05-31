<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dashboard')</title>
</head>
<body>
    <p><a href="{{ route('logout') }}">Logout</a></p>
    <h1>Welcome, {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <img src="{{ $user->avatar }}" alt="Avatar" width="100">

    <br>

    <p><a href="{{ route('users.index') }}"> Go to Users</a></p>
</body>
</html>
