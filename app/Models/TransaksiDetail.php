<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
   protected $table = 'transaksi_detail';
    protected $fillable = [
        'transaksi_id',
        'product_id',
        'qty',
        'harga',
        'subtotal'
    ];
    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
