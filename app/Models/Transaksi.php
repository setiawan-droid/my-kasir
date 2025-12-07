<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'total', 'bayar', 'kembalian'];

    public function details()
    {
         return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
    public function detail()
{
    return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
}
}
