<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $user = Auth::user();
        DB::beginTransaction();

        try {
            $products = Product::whereIn('id_barang', array_keys($cart))->lockForUpdate()->get();
            $totalHarga = 0;

            foreach ($products as $product) {
                $qty = $cart[$product->id_barang];
                if ($qty > $product->stok) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', "Stok barang '{$product->nama_barang}' tidak mencukupi!");
                }
                $totalHarga += $product->harga * $qty;
            }

            $id_order = 'ORD-' . strtoupper(Str::random(8));

            $order = Order::create([
                'id_order'          => $id_order,
                'id_user'           => $user->id_user,
                'tanggal_order'     => now(),
                'total_harga'       => $totalHarga,
                'alamat_pengiriman' => $user->alamat ?? 'Alamat Belum Diisi',
            ]);

            foreach ($products as $product) {
                $qty = $cart[$product->id_barang];

                OrderDetail::create([
                    'id_order'     => $order->id_order,
                    'id_barang'    => $product->id_barang,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli'  => $qty,
                ]);

                $product->decrement('stok', $qty);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Checkout berhasil! Pesanan Anda telah diproses.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses checkout.');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('id_user', $user->id_user)
            ->with('details.product')
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }
}
