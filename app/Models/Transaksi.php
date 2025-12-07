<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi'; // atau 'transaksis' sesuai DB
    protected $fillable = ['kode_transaksi','total','diskon_persen','diskon_rp','grand_total','bayar','kembalian','user_id','wa'];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
