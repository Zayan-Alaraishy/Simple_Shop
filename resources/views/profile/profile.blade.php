<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Profile Page</h1>

    @if ($isPublic)
    <p><strong>Username:</strong> {{ $username }}</p>
    @else
    <p><strong>Private Account</strong></p>
    @endif

    @if (Auth::check() && Auth::user()->id === $userId)
        @if (Auth::check() && Auth::user()->id === $userId && ! $isPublic)
            <p><strong>Username:</strong> {{ $username }}</p>
        @endif

    <p><strong>Email:</strong> {{ $email }}</p>

    <form action="{{ route('updateEmail') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="email" name="email" placeholder="Enter your new email">
        <button type="submit">Update Email</button>
        @error('email')
        <div>{{ $message }}</div>
        @enderror
    </form>

    <form action="{{ route('updateUsername') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="username" placeholder="Enter your new username">
        <button type="submit">Update Username</button>
        @error('username')
        <div>{{ $message }}</div>
        @enderror
    </form>

    <form action="{{ route('toggleAccountPrivacy') }}" method="POST">
        @csrf
        <button type="submit">
            @if ($isPublic)
            Make Account Private
            @else
            Make Account Public
            @endif
        </button>
    </form>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
        <a href="{{ route('home') }}">Home</a>
    </form>
</body>

</html>