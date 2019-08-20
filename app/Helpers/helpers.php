<?php
namespace App\Helpers;

use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;
use Illuminate\Support\Facades\DB;

class helpers
{
    public static function penjumlahan()
    {
        $hasilPenjumlahan = 1 + 2;
        return $hasilPenjumlahan;
    }

    function MenuKriteria(){
        $kriterias = \App\Kriteria::all();
        return $kriterias;
    }
}
