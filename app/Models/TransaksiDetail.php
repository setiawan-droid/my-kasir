<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = ['transaksi_id','product_id','qty','harga','diskon_persen','diskon','subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
