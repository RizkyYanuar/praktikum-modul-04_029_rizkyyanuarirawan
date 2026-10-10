<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $totalHarga = 0;

        if (!empty($cart)) {
            $products = Product::whereIn('id_barang', array_keys($cart))->get();

            foreach ($products as $product) {
                $qty = $cart[$product->id_barang];
                $subtotal = $product->harga * $qty;
                $totalHarga += $subtotal;

                $cartItems[] = [
                    'product'  => $product,
                    'jumlah'   => $qty,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.index', compact('cartItems', 'totalHarga'));
    }

    public function add(Request $request, $id_barang)
    {
        $product = Product::findOrFail($id_barang);
        $jumlah = (int) $request->input('jumlah', 1);

        $cart = session()->get('cart', []);
        $currentQty = $cart[$id_barang] ?? 0;
        $newQty = $currentQty + $jumlah;

        if ($newQty > $product->stok) {
            return back()->with('error', "Jumlah melebihi stok yang tersedia! (Stok tersisa: {$product->stok})");
        }

        $cart[$id_barang] = $newQty;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id_barang)
    {
        $product = Product::findOrFail($id_barang);
        $jumlah = (int) $request->input('jumlah');

        if ($jumlah <= 0) {
            return $this->remove($id_barang);
        }

        if ($jumlah > $product->stok) {
            return back()->with('error', "Stok tidak mencukupi! Maksimal pembelian: {$product->stok}");
        }

        $cart = session()->get('cart', []);
        $cart[$id_barang] = $jumlah;
        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah barang di keranjang berhasil diperbarui.');
    }

    public function remove($id_barang)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id_barang])) {
            unset($cart[$id_barang]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}