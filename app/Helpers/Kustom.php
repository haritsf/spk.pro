<?php

namespace App\Helpers;

use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;
use Illuminate\Support\Facades\DB;

class Kustom
{
    public static function JoinanTabel($id)
    {
        // AMBIL SEMUA
        // $data = DB::table('alternatifs')->select('alternatifs.nama','evals.id as id','kriterias.nama as kriteria','evals.nilai as nilai')->join('evals','alternatifs.id','=','evals.alternatif')->join('kriterias','evals.kriteria','=','kriterias.id')->get();

        // AMBIL BERDASARKAN ID
        $data = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai', 'klasifikasis.klasifikasi')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->join('klasifikasis', 'evals.nilai', '=', 'klasifikasis.nilai')->where('alternatifs.id', '=', $id)->get();
        // dd($data);
        return $data;
    }

    public static function MenuKriteria()
    {
        $kriterias = Kriteria::all();
        return $kriterias;
    }

    public static function CountAlternatifs()
    {
        $countalternatifs = Alternatif::count();
        return $countalternatifs;
    }

    public static function CountKriterias()
    {
        $countkriterias = Kriteria::count();
        return $countkriterias;
    }
}
