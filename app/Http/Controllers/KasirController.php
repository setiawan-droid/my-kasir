<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;




class KasirController extends Controller
{
    public function index()
    {
            $products = Product::all();
        $cart = session()->get('cart', []);
        return view('kasir.index', compact('products', 'cart'));
    }
     public function addToCart(Request $request)
        {
            $product = Product::findOrFail($request->product_id);
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['qty'] += $request->qty;
            } else {
               $diskon = $product->diskon_persen ?? 0;
                $harga_diskon = $product->harga - ($product->harga * $diskon / 100);

                $cart[$product->id] = [
                    'name' => $product->nama,
                    'price' => $harga_diskon, // harga setelah diskon
                    'qty' => $request->qty,
                    'diskon_persen' => $diskon
                ];

            }

            session()->put('cart', $cart);
            return redirect()->route('kasir.index')->with('success', 'Produk ditambahkan');
        }

         

    public function histori()
        {
            $transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
            return view('kasir.histori', compact('transaksi'));
        }

    public function detail($id)
        {
            $transaksi = Transaksi::findOrFail($id);
            $detail = TransaksiDetail::where('transaksi_id', $id)->get();
            return view('kasir.detail', compact('transaksi', 'detail'));
        }
        public function show($id)
            {
                $transaksi = Transaksi::findOrFail($id);
                $detail = TransaksiDetail::where('transaksi_id', $id)->get();
                return view('kasir.detail', compact('transaksi', 'detail'));
            }

    public function showDetail($id)
        {
            $transaksi = Transaksi::findOrFail($id);
            $detail = TransaksiDetail::where('transaksi_id', $id)->get();
            return view('kasir.detail', compact('transaksi', 'detail'));
        }
        public function checkout(Request $request)
{
    $cart = session('cart', []);
    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
    $bayar = $request->bayar;
    $diskonPersen = $request->diskon_persen ?? 0;
    $diskonNominal = $total * ($diskonPersen / 100);
    $grandTotal = $total - $diskonNominal;
    $kembalian = $bayar - $grandTotal;

    // 1️⃣ Simpan transaksi dulu
    $transaksi = Transaksi::create([
        'kode_transaksi' => 'TRX-' . date('YmdHis'),
        'total' => $total,
        'diskon_persen' => $diskonPersen,
        'diskon_rp' => $diskonNominal,
        'grand_total' => $grandTotal,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'user_id' => auth()->id(),
    ]);

    // 2️⃣ Simpan detail transaksi
    foreach ($cart as $productId => $item) {
        TransaksiDetail::create([
            'transaksi_id' => $transaksi->id,   // aman, sudah ada
            'product_id'   => $productId,
            'qty'          => $item['qty'],
            'harga'        => $item['price'],
            'diskon_persen'=> $item['diskon_persen'] ?? 0,
            'subtotal'     => ($item['price'] * $item['qty'])
        ]);

        // 3️⃣ Kurangi stok produk
        Product::where('id', $productId)->decrement('stok', $item['qty']);
    }

    // 4️⃣ Kosongkan keranjang
    session()->forget('cart');

    return redirect()->route('transaksi.show', $transaksi->id)
        ->with('success', 'Checkout berhasil!');
}


}

