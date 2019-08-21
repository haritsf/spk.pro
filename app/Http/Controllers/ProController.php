<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Kustom;
use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;
use App\Pengguna;
use App\User;
// use Session;

class ProController extends Controller
{
    public function joinevaluasi($id)
    {
        $joins = DB::table('evals')->select('evals.id as id', 'alternatifs.nama as alternatif', 'kriterias.nama as kriteria', 'evals.nilai as nilai')->join('alternatifs', 'alternatifs.id', '=', 'evals.alternatif')->join('kriterias', 'evals.kriteria', '=', 'kriterias.id')->where('kriterias.id', '=', $id)->get();
        // dd($joins);
        // return view('pages/promethee/deviasi', ['joins' => $joins]);
        return $joins;
    }

    public function deviasi($getjoins, $x, $y){
        $nilaideviasi = $getjoins[$x]['nilai'] - $getjoins[$y]['nilai'];
        return $nilaideviasi;
    }

    public function viewdeviasi()
    {
        for ($x = 1; $x <= Kustom::CountAlternatifs(); $x++) {
            for ($y = 1; $y <= Kustom::CountAlternatifs(); $y++) {
                for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
                    $getjoins = ProController::joinevaluasi($id);
                }
            }
        }
        return view('pages/promethee/deviasi', ['getjoins' => $getjoins]);
    }
}
