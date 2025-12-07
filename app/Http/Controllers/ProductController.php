<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'diskon_persen' => 'nullable|integer|min:0|max:100'
        ]);

        // Simpan sesuai input form
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'diskon_persen' => 'nullable|integer|min:0|max:100'
        ]);

        Product::where('id', $id)->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
