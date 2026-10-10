<!DOCTYPE html>
<html lang="id">

<head>
    <title>Daftar Akun</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen bg-gray-100 flex justify-center items-center">
    <main class="bg-white p-8 rounded-lg shadow-md ">
        <h2 class="text-2xl font-bold mb-4">Daftar Akun</h2>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                class="border border-gray-300 rounded-md px-2 py-1">

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="border border-gray-300 rounded-md px-2 py-1">

            <div class="flex gap-4">
                <label>Username:</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                    class="border border-gray-300 rounded-md px-2 py-1">

                <label>Password:</label>
                <input type="password" name="password" required class="border border-gray-300 rounded-md px-2 py-1">
            </div>

            <label>No. HP:</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                class="border border-gray-300 rounded-md px-2 py-1">

            <label>Alamat:</label>
            <textarea name="alamat" class="border border-gray-300 rounded-md px-2 py-1">{{ old('alamat') }}</textarea>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                Daftar
            </button>
        </form>
        <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login di sini</a></p>
    </main>
</body>

</html>
