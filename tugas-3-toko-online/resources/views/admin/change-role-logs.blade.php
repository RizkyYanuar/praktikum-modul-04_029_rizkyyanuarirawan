@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Log Perubahan Role Pengguna
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Riwayat perubahan role pengguna dalam sistem.
        </p>
    </div>

    <div class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-gray-500">
            Total perubahan role tercatat
        </p>

        <p class="mt-1 text-2xl font-bold text-gray-800">
            {{ number_format($logs->total(), 0, ',', '.') }}
        </p>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Waktu
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Pelaku
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Aktivitas
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Target
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Perubahan Role
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse ($logs as $log)
                        <tr class="transition hover:bg-gray-50">

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-600">
                                <div class="font-medium text-gray-800">
                                    {{ $log->created_at?->format('d-m-Y') ?? '-' }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $log->created_at?->format('H:i:s') ?? '-' }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-sm">
                                <div class="font-medium text-gray-800">
                                    {{ $log->user?->nama_lengkap ?? 'Pengguna tidak tersedia' }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $log->id_user }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-sm">
                                @switch($log->action)
                                    @case('user.role.changed')
                                        <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                            Perubahan Role
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                            {{ $log->action }}
                                        </span>
                                @endswitch
                            </td>

                            <td class="px-5 py-4 text-sm">
                                <div class="font-medium text-gray-800">
                                    {{ $log->targetUser?->nama_lengkap ?? 'Pengguna tidak tersedia' }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $log->target_user_id ?? '-' }}
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm">
                                @if ($log->old_role || $log->new_role)
                                    <div class="flex items-center gap-2">
                                        <span class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700">
                                            {{ $log->old_role ?? '-' }}
                                        </span>

                                        <span class="text-gray-400">
                                            →
                                        </span>

                                        <span class="rounded bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                            {{ $log->new_role ?? '-' }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-400">Tidak ada perubahan role</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="text-base font-medium text-gray-700">
                                    Belum ada aktivitas
                                </div>

                                <p class="mt-1 text-sm text-gray-500">
                                    Aktivitas yang tercatat akan muncul di halaman ini.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        @if ($logs->hasPages())
            <div class="flex flex-col gap-4 border-t border-gray-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-semibold">{{ $logs->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-semibold">{{ $logs->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-semibold">{{ $logs->total() }}</span>
                    aktivitas
                </p>

                <div class="flex flex-wrap items-center gap-1">

                    @if ($logs->onFirstPage())
                        <span class="cursor-not-allowed rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-400">
                            &laquo; Sebelumnya
                        </span>
                    @else
                        <a href="{{ $logs->previousPageUrl() }}"
                           class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">
                            &laquo; Sebelumnya
                        </a>
                    @endif

                    @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                        @if ($page === $logs->currentPage())
                            <span aria-current="page"
                                  class="rounded-lg border border-blue-600 bg-blue-600 px-3 py-2 text-sm font-semibold text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($logs->hasMorePages())
                        <a href="{{ $logs->nextPageUrl() }}"
                           class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100">
                            Berikutnya &raquo;
                        </a>
                    @else
                        <span class="cursor-not-allowed rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-400">
                            Berikutnya &raquo;
                        </span>
                    @endif

                </div>
            </div>
        @endif

    </div>
</div>
@endsection
