<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // daftar produk
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('produk.index', compact('products'));
    }

    // form tambah
    public function create()
    {
        return view('produk.create');
    }

    // simpan produk
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'diskon_persen' => 'nullable|integer|min:0|max:100'
        ]);

        // simpan semua field yang tervalidasi
        Product::create($validated);

        return redirect()->route('products.index')->with('success','Produk berhasil ditambahkan');
    }

    // form edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('product'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'diskon_persen' => 'nullable|integer|min:0|max:100'
        ]);

        Product::where('id',$id)->update($validated);
        return redirect()->route('products.index')->with('success','Produk diperbarui');
    }

    // hapus
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success','Produk dihapus');
    }
}
