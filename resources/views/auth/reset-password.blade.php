<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}">
    @error('email')
    <div>{{ $message }}</div>
    @enderror
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    @error('password')
    <div>{{ $message }}</div>
    @enderror
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    @error('password_confirmation')
    <div>{{ $message }}</div>
    @enderror
    <button type="submit"> submit </button>
    <div>    @if (session('status'))
        {{ session('status') }}
    @endif
</div>

</form>