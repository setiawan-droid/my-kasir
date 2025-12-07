<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('created_at','desc')->get();
        return view('riwayat.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        return view('riwayat.show', compact('transaksi'));
    }

    // cetak PDF (barryvdh/dompdf harus terinstall)
    public function cetakPdf($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        $data = ['transaksi' => $transaksi, 'detail' => $transaksi->details];

        // gunakan fully-qualified facade untuk menghindari import yang error
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.struk', $data)->setPaper('A4','portrait');
        return $pdf->stream('struk-'.$transaksi->kode_transaksi.'.pdf');
    }

    // print thermal (HTML kecil)
    public function printThermal($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        return view('transaksi.print', ['transaksi'=>$transaksi, 'detail'=>$transaksi->details]);
    }

    // laporan form
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

        $data = Transaksi::whereBetween('created_at', [$request->awal.' 00:00:00', $request->akhir.' 23:59:59'])
                ->with('details.product')->orderBy('created_at','asc')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.laporan_pdf', [
            'data' => $data,
            'awal' => $request->awal,
            'akhir' => $request->akhir
        ])->setPaper('A4','portrait');

        return $pdf->stream('laporan-'.$request->awal.'-'.$request->akhir.'.pdf');
    }
}
