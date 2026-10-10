@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col justify-between">
                    
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if ($product->gambar)
                            <img src="{{ asset('storage/img/' . $product->gambar) }}" alt="{{ $product->nama_barang }}"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                        @endif
                    </div>

                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg mb-1 line-clamp-2">
                                {{ $product->nama_barang }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-2">
                                Stok: 
                                @if ($product->stok > 0)
                                    <span class="text-green-600 font-medium">{{ $product->stok }}</span>
                                @else
                                    <span class="text-red-500 font-medium">Habis</span>
                                @endif
                            </p>
                        </div>

                        <div class="mt-4">
                            <span class="text-indigo-600 font-bold text-lg block mb-3">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </span>

                            @auth
                                <form action="{{ route('cart.add', $product->id_barang) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jumlah" value="1">
                                    
                                    <button type="submit" 
                                        @if ($product->stok <= 0) disabled @endif
                                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition duration-200 text-sm font-medium disabled:bg-gray-300 disabled:cursor-not-allowed">
                                        {{ $product->stok > 0 ? 'Masukkan Ke Krj' : 'Stok Habis' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" 
                                    class="w-full block text-center bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-200 transition duration-200 text-sm font-medium">
                                    Login untuk Membeli
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection