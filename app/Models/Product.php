<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function transaksi_detail()
{
    return $this->hasMany(TransaksiDetail::class);
}
protected $fillable = ['nama','harga','stok','diskon_persen'];

}
