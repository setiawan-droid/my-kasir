<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $totalHariIni = Transaksi::whereDate('created_at', $hariIni)->sum('grand_total');
        $jumlahTransaksiHariIni = Transaksi::whereDate('created_at', $hariIni)->count();
        $qtyTerjualHariIni = TransaksiDetail::whereDate('created_at', $hariIni)->sum('qty');

        // data grafik 7 hari terakhir
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $labels[] = $tanggal->format('d M');
            $data[] = Transaksi::whereDate('created_at', $tanggal)->sum('grand_total');
        }

        return view('dashboard', compact(
            'totalHariIni',
            'jumlahTransaksiHariIni',
            'qtyTerjualHariIni',
            'labels',
            'data'
        ));
    }
}
