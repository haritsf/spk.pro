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
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function viewdeviasi()
    // {
    //     for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
    //         $getjoins = ProController::joinevaluasi($id);
    //         $showdeviasi[] = $getjoins;
    //     }
    //     // dd($showdeviasi);
    //     return view('pages/promethee/deviasi', ['showdeviasi' => $showdeviasi]);
    // }

    // public function deviasi()
    // {
    //     for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
    //         $getjoins = ProController::joinevaluasi($id);
    //         $showdeviasi[] = $getjoins;
    //     }
    //     foreach ($showdeviasi as $deviasi => $value) {
    //         for ($x = 0; $x < Kustom::CountAlternatifs(); $x++) {
    //             for ($y = 0; $y < Kustom::CountAlternatifs(); $y++) {
    //                 $subs[] = ($value[$x]->nilai) - ($value[$y]->nilai);
    //             }
    //         }
    //     }
    //     // var_dump($subs);
    //     return $subs;
    // }

    // public function viewdeviasi()
    // {
    //     $subs = ProController::deviasi();
    //     // dd($subs);
    //     return view('pages/promethee/deviasi', ['subs' => $subs]);
    // }

    public function deviasi($joins, $x, $y)
    {
        $nilaideviasi = $joins[$x]['nilai'] - $joins[$y]['nilai'];
        return $nilaideviasi;
    }

    public function viewdeviasi()
    {
        for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
            $getjoins = ProController::joinevaluasi($id);
            $showdeviasi[] = $getjoins;
        }
        // dd($showdeviasi);
        return view('pages/promethee/deviasi', ['showdeviasi' => $showdeviasi]);
    }

    public function joinevaluasi($id)
    {
        $joins = DB::table('evals')->select('evals.id as id', 'alternatifs.nama as alternatif', 'kriterias.nama as kriteria', 'kriterias.bobot', 'evals.nilai as nilai')->join('alternatifs', 'alternatifs.id', '=', 'evals.alternatif')->join('kriterias', 'evals.kriteria', '=', 'kriterias.id')->where('kriterias.id', '=', $id)->get();
        return $joins;
    }
}
