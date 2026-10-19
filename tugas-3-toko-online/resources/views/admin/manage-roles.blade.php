@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4">
            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-700">
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4">
            {{ session('status') }}
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Pengguna
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Kelola data pengguna dan atur role setiap akun.
            </p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-base font-semibold text-gray-800">
                    Daftar Pengguna
                </h2>

                <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
                    {{ $users->count() }} pengguna
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                No.
                            </th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama Lengkap
                            </th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Username
                            </th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Email
                            </th>

                            <th scope="col"
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Role
                            </th>

                            <th scope="col"
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->nama_lengkap }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">
                                        {{ $user->username }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">
                                        {{ $user->email }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($user->role === 'admin')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                            Admin
                                        </span>
                                    @elseif ($user->role === 'staff')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            Staff
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Customer
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($user->role === 'customer')
                                        <form action="{{ route('admin.users.role.update', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="role" value="staff">

                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                                Jadikan Staff
                                            </button>
                                        </form>
                                    @elseif ($user->role === 'staff')
                                        <form action="{{ route('admin.users.role.update', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="role" value="customer">

                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                                Jadikan Customer
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 italic">
                                            Tidak tersedia
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-sm font-medium text-gray-500">
                                        Belum ada data pengguna.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Footer Tabel --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-xs text-gray-500">
                    Menampilkan {{ $users->count() }} pengguna.
                </p>
            </div>

        </div>
    </div>
@endsection
