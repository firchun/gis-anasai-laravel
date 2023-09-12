<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kegiatan;
use App\Models\Lapak;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function wisata()
    {
        $data = [
            'title' => 'Laporan Wisata',
            'wisata' => Wisata::all(),
        ];
        return view('pages.laporan.wisata', $data);
    }
    public function lapak()
    {
        $data = [
            'title' => 'Laporan Lapak',
            'lapak' => Lapak::all(),
        ];
        return view('pages.laporan.lapak', $data);
    }
    public function desa()
    {
        $data = [
            'title' => 'Laporan Desa',
            'desa' => Wisata::all(),
        ];
        return view('pages.laporan.desa', $data);
    }
    public function kegiatan()
    {
        $data = [
            'title' => 'Laporan Kegiatan',
            'kegiatan' => Kegiatan::all(),
        ];
        return view('pages.laporan.kegiatan', $data);
    }
    public function exportWisata()
    {
        $data = Wisata::all();
        $pdf =  \PDF::loadView('pages.laporan.pdf.pdf_wisata', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Wisata ' . date('d-m-Y') . '.pdf');
    }
    public function exportDesa()
    {
        $data = Desa::all();
        $pdf =  \PDF::loadView('pages.laporan.pdf.pdf_desa', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Desa ' . date('d-m-Y') . '.pdf');
    }
    public function exportKegiatan()
    {
        $data = Kegiatan::all();
        $pdf =  \PDF::loadView('pages.laporan.pdf.pdf_kegiatan', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Event ' . date('d-m-Y') . '.pdf');
    }
    public function exportLapak()
    {
        $data = Lapak::all();
        $pdf =  \PDF::loadView('pages.laporan.pdf.pdf_lapak', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Data Lapak ' . date('d-m-Y') . '.pdf');
    }
}
