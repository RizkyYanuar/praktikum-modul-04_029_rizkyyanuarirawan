@extends('layouts.app')

@section('content')
<div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Pesanan Saya</h2>
        <a href="{{ url('/') }}" class="text-indigo-600 hover:underline text-sm font-medium">&larr; Kembali Belanja</a>
    </div>

    @if ($orders->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg mb-4">Anda belum memiliki riwayat transaksi pesanan.</p>
            <a href="{{ url('/') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-md hover:bg-indigo-700 text-sm font-medium">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="flex flex-col gap-6">
            @foreach ($orders as $order)
                <div class="border border-gray-200 rounded-lg p-5 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4 pb-3 border-b border-gray-200 gap-2">
                        <div>
                            <span class="text-xs font-bold uppercase bg-indigo-100 text-indigo-800 px-2.5 py-1 rounded">
                                ID: {{ $order->id_order }}
                            </span>
                            <p class="text-xs text-gray-500 mt-2">
                                Waktu Order: {{ $order->tanggal_order->format('d M Y, H:i') }} WIB
                            </p>
                        </div>
                        <div class="sm:text-right">
                            <span class="text-xs text-gray-500 block">Total Pembayaran</span>
                            <p class="text-xl font-bold text-indigo-600">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4 text-sm text-gray-700">
                        <strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}
                    </div>

                    <div class="bg-white p-4 rounded-md border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Detail Barang Dibeli:</h4>
                        <ul class="divide-y divide-gray-100 text-sm">
                            @foreach ($order->details as $detail)
                                <li class="py-2.5 flex justify-between items-center">
                                    <div>
                                        <span class="font-medium text-gray-800">
                                            {{ $detail->product->nama_barang ?? 'Produk Tidak Tersedia' }}
                                        </span>
                                        <span class="text-gray-500 text-xs ml-2">
                                            ({{ $detail->jumlah_beli }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }})
                                        </span>
                                    </div>
                                    <span class="font-semibold text-gray-800">
                                        Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection