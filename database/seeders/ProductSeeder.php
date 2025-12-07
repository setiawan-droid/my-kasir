<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    Product::create(['name'=>'Buku Tulis','sku'=>'BK001','price'=>5000,'stock'=>100]);
    Product::create(['name'=>'Pulpen','sku'=>'PN001','price'=>3000,'stock'=>200]);
    Product::create(['name'=>'Penghapus','sku'=>'PH001','price'=>2000,'stock'=>150]);
    }
}
