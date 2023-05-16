    <form class="register-from" action={{ route('signup') }} method="Post">
        @csrf
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <div>{{ $message }}</div>
        @enderror

        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
        @error('username')
            <div>{{ $message }}</div>
        @enderror

        <input type="password" name="password" placeholder="Password">
        @error('password')
            <div>{{ $message }}</div>
        @enderror
        <input type="password" name="password_confirmation" placeholder="Confrim Password">
        <button type="submit">Signup</button>

    </form>
