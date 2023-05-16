<form method="POST" action={{ route('login') }}>
    @csrf
    <!-- old read from the old session data -->
    @if (session('status'))
        {{ session('status') }}
    @endif
    <label for="login">Email or Username</label>
    <input type="text" id="login" name="login">
    @error('login')
    <div>{{ $message }}</div>
@enderror
    <input type="password" id="password" name="password">
    @error('login')
    <div>{{ $password }}</div>
@enderror
    <button type="submit"> submit </button>

    <!-- Other form fields and submit button -->
</form>
