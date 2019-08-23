<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\helpers;

class con_data extends Controller
{
    // KECAMATAN
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function kecamatan()
    {
        $alternatifs = \App\Alternatif::all();
        return view('pages/data/kecamatan/view', ['alternatifs' => $alternatifs]);
    }

    public function createkecamatan(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $kode = $request->kode;
        \App\Alternatif::create($request->all());
        return redirect()->back()->with('success', 'Kecamatan Berhasil di Tambah');
    }

    public function editkecamatan($id)
    {
        $alternatif = \App\Alternatif::find($id);
        // dd($alternatif);
        return view('pages/data/kecamatan/edit', ['alternatif' => $alternatif]);
    }

    public function updatekecamatan($id)
    {
        $alternatif = \App\Alternatif::find($id);
        dd($alternatif);
        // $alternatif->name = 'New Flight Name';
        // return view('pages/data/kecamatan/view', ['alternatif' => $alternatif]);
    }

    public function deletekecamatan($id)
    {
        DB::table('alternatifs')->where('id', $id)->delete();
        return redirect()->back()->with('danger', 'Kecamatan Berhasil di Hapus');
    }

    // KECAMATAN

    // KRITERIA
    public function kriteria()
    {
        $data = [
            'kriterias' => DB::table('kriterias')->get()
        ];
        return view('pages/data/kriteria', $data);
    }

    // PREFERENSI
    public function preferensi()
    {
        // dd(kustom::penjumlahan());
        $data = [
            'prefs' => DB::table('prefs')->get()
        ];
        return view('pages/data/preferensi', $data);
    }
}
