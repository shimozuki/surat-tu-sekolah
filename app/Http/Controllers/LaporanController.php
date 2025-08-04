<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->get('jenis', 'masuk'); // default: surat masuk
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status'); // hanya berlaku utk surat keluar

        if ($jenis === 'keluar') {
            $query = SuratKeluar::query();

            if ($status) {
                $query->where('status_persetujuan', $status);
            }
        } else {
            $query = SuratMasuk::query();
        }

        // filter tanggal jika ada
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $surat = $query->latest()->paginate(10);

        return view('pages.laporan.index', compact('surat', 'jenis', 'startDate', 'endDate', 'status'));
    }
}
