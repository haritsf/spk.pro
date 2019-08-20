<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class con_kriteria extends Controller
{

    public function kriteriaview($id)
    {
        $datas = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->where('evals.kriteria', '=', $id)->get();
        // dd($datas);
        return view('pages/data/kriteria/view', compact('datas'));
    }

    public function kriteriaedit($id)
    {
        $datas = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->where('evals.kriteria', '=', $id)->get();
        // dd($datas);
        return view('pages/kriteria/view', compact('datas'));
    }
}
