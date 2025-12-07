<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // pastikan nama tabel sesuai migration
    protected $fillable = ['nama','harga','stok','diskon_persen'];

    // optional: default diskon zero
    protected $attributes = [
        'diskon_persen' => 0,
    ];
}
