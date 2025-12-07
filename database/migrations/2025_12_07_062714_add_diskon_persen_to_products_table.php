<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
    if (!Schema::hasColumn('products','diskon_persen')) {
        $table->integer('diskon_persen')->default(0);
    }
});
Schema::table('transaksi_detail', function (Blueprint $table) {
    if (!Schema::hasColumn('transaksi_detail','diskon_persen')) {
        $table->integer('diskon_persen')->default(0);
    }
    if (!Schema::hasColumn('transaksi_detail','diskon')) {
        $table->integer('diskon')->default(0);
    }
    if (!Schema::hasColumn('transaksi_detail','subtotal')) {
        $table->integer('subtotal')->nullable();
    }
});
Schema::table('transaksi', function (Blueprint $table) {
    if (!Schema::hasColumn('transaksi','diskon_persen')) {
        $table->integer('diskon_persen')->default(0);
    }
    if (!Schema::hasColumn('transaksi','diskon_rp')) {
        $table->integer('diskon_rp')->default(0);
    }
    if (!Schema::hasColumn('transaksi','grand_total')) {
        $table->integer('grand_total')->nullable();
    }
    if (!Schema::hasColumn('transaksi','wa')) {
        $table->string('wa')->nullable();
    }
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
