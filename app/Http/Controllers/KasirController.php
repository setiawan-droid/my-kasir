<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class KasirController extends Controller
{
    // tampil halaman kasir
    public function index()
    {
        $products = Product::orderBy('nama')->get();
        $cart = session()->get('cart', []);
        // total dihitung di view atau di controller
        return view('kasir.index', compact('products','cart'));
    }

    // tambah ke cart (session)
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = max(1, (int) $request->qty);
        // gunakan diskon default produk (persen)
        $diskonPersen = $product->diskon_persen ?? 0;
        // hitung harga setelah diskon per unit
        $hargaDiskon = round($product->harga - ($product->harga * $diskonPersen / 100));

        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])){
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->nama,
                'price' => $hargaDiskon,
                'qty' => $qty,
                'diskon_persen' => $diskonPersen
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('kasir.index')->with('success','Produk ditambahkan ke keranjang');
    }

    // hapus item dari cart (via POST)
    public function removeFromCart(Request $request)
    {
        $productId = $request->product_id;
        $cart = session()->get('cart', []);
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart',$cart);
        }
        return redirect()->route('kasir.index')->with('success','Item dihapus');
    }

    // checkout - simpan transaksi lalu detail
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)){
            return redirect()->route('kasir.index')->with('error','Keranjang kosong');
        }

        // hitung total dari cart (harga sudah after-discount per item)
        $total = 0;
        foreach($cart as $it){
            $total += ($it['price'] * $it['qty']);
        }

        $bayar = (int) $request->bayar;
        $diskonPersen = (int) ($request->diskon_persen ?? 0);
        $diskonTransaksiNominal = round($total * ($diskonPersen / 100));
        $grandTotal = $total - $diskonTransaksiNominal;
        $kembalian = $bayar - $grandTotal;

        // simpan transaksi dulu
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-'.time(),
            'total' => $total,
            'diskon_persen' => $diskonPersen,
            'diskon_rp' => $diskonTransaksiNominal,
            'grand_total' => $grandTotal,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'user_id' => auth()->id() ?? null,
            'wa' => $request->wa ?? null
        ]);

        // simpan detail transaksi dan update stok
        foreach($cart as $productId => $item){
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $productId,
                'qty' => $item['qty'],
                'harga' => $item['price'],
                'diskon_persen' => $item['diskon_persen'] ?? 0,
                'diskon' => round(($item['price'] * $item['qty']) * (($item['diskon_persen'] ?? 0)/100)),
                'subtotal' => ($item['price'] * $item['qty']) - round(($item['price'] * $item['qty']) * (($item['diskon_persen'] ?? 0)/100))
            ]);

            // update stok asli (jika ada)
            Product::where('id',$productId)->decrement('stok', $item['qty']);
        }

        // kosongkan session cart
        session()->forget('cart');

        return redirect()->route('transaksi.show', $transaksi->id)->with('success','Transaksi berhasil');
    }

    // histori & detail
    public function histori()
    {
        $transaksi = Transaksi::orderBy('created_at','desc')->get();
        return view('kasir.histori', compact('transaksi'));
    }

    public function showDetail($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        return view('kasir.detail', compact('transaksi'));
    }
}
