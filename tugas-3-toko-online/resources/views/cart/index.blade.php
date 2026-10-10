@extends('layouts.app')

@section('content')
<div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Keranjang Belanja</h2>
        <a href="{{ url('/') }}" class="text-indigo-600 hover:underline text-sm font-medium">&larr; Kembali Belanja</a>
    </div>

    @if (empty($cartItems))
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg mb-4">Keranjang belanja Anda masih kosong.</p>
            <a href="{{ url('/') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-md hover:bg-indigo-700 text-sm font-medium">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-gray-700 text-sm">
                        <th class="py-3 px-4" colspan   ="2">Barang</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4">Jumlah</th>
                        <th class="py-3 px-4">Subtotal</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach ($cartItems as $item)
                        <tr>
                            <td class="py-3 px-4">
                                @if($item['product']->gambar)
                                    <img src="{{ asset('storage/img/' . $item['product']->gambar) }}" class="w-12 h-12 object-cover rounded" alt="produk">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $item['product']->nama_barang }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($item['product']->harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('cart.update', $item['product']->id_barang) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" max="{{ $item['product']->stok }}"
                                        class="w-16 border border-gray-300 rounded px-2 py-1 text-center focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 px-2 py-1 rounded text-xs text-gray-700 font-medium">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4 font-semibold text-gray-800">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-center">
                                <form action="{{ route('cart.remove', $item['product']->id_barang) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus barang ini dari keranjang?')" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
            <span class="text-lg font-bold text-gray-800">Total Harga Barang:</span>
            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-indigo-600 text-white py-2.5 px-6 rounded-md hover:bg-indigo-700 font-medium transition duration-200 shadow-sm">
                    Checkout Sekarang
                </button>
            </form>
        </div>
    @endif
</div>
@endsection