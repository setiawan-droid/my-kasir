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
     public function addToCart(Request $request, CartService $cart)
{
    $cart->addToCart($request->product_id, $request->qty);

    return back()->with('success', 'Produk ditambahkan');
}

public function removeFromCart($id, CartService $cart)
{
    $cart->removeItem($id);

    return back()->with('success', 'Item dihapus');
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
        public function checkout(Request $request, 
    CartService $cart,
    CheckoutService $checkout,
    PaymentContext $payment
) {
    // pilih strategi
    if ($request->payment === 'cash') {
        $payment->setStrategy(new CashPayment());
    } else {
        $payment->setStrategy(new QrisPayment());
    }

    // proses pembayaran
    $paymentResult = $payment->processPayment($cart->getTotal());

    // lakukan checkout transaksi
    $trx = $checkout->checkout($paymentResult);

    return redirect()->route('transaksi.show', $trx->id)
        ->with('success', 'Checkout berhasil');
}


}

