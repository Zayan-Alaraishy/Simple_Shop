<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This is your Profile Page</h1>
    <!--  i need a form for update email and another for update username and this is my routes :     Route::put('/update-username', [ProfileController::class, 'updateUsername'])->name('updateUsername');
    Route::put('/update-email', [ProfileController::class, 'updateEmail'])->name('updateEmail');
-->


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

</body>
</html>