<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class CheckoutService
{
    private CartService $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function checkout($paymentData)
    {
        $cart = session()->get('cart', []);

        // 1. Buat Transaksi
        $transaksi = Transaksi::create([
            'kode_trx' => 'TRX-' . time(),
            'total' => $this->cart->getTotal(),
            'payment_method' => $paymentData['method'],
            'payment_status' => $paymentData['status'],
        ]);

        // 2. Detail transaksi
        foreach ($cart as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $item['id'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
            ]);

            Product::where('id', $item['id'])->decrement('stok', $item['qty']);
        }

        // 3. Bersihkan Cart
        $this->cart->clear();

        return $transaksi;
    }
}
