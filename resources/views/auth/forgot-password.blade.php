<!-- form to forgot password -->
<form method="POST" action={{ route('password.email') }}>
    @csrf
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    @error('email')
        <div>{{ $message }}</div>
    @enderror
    <button type="submit">Submit</button>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif
    
</form>
