<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h2>Login</h2>

    @error('loginError')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>