<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('id', 'DESC')->get();
        return view('riwayat.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detail = TransaksiDetail::where('transaksi_id', $id)->get();
        return view('riwayat.show', compact('transaksi', 'detail'));
       

    }
  

public function cetakPdf($id)
{
    $transaksi = Transaksi::with('detail.product')->findOrFail($id);
    $detail = $transaksi->detail; // ambil detail transaksi

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.struk', [
        'transaksi' => $transaksi,
        'detail' => $detail
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('struk-'.$transaksi->kode_transaksi.'.pdf');
}
public function laporan()
{
    return view('transaksi.laporan');
}

public function cetakLaporan(Request $request)
{
    $request->validate([
        'awal' => 'required|date',
        'akhir' => 'required|date|after_or_equal:awal'
    ]);

    $data = Transaksi::whereBetween('created_at', [$request->awal, $request->akhir])
            ->with('detail.product')
            ->orderBy('created_at', 'ASC')
            ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.laporan_pdf', [
        'data' => $data,
        'awal' => $request->awal,
        'akhir' => $request->akhir
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('laporan-transaksi.pdf');
}
public function printThermal($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $detail = TransaksiDetail::where('transaksi_id', $id)->get();

    return view('transaksi.print', compact('transaksi', 'detail'));
}

}
