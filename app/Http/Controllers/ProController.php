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

    public function ViewNet()
    {
        return view('pages/promethee/net');
    }

    public function ViewEntering()
    {
        return view('pages/promethee/entering');
    }

    public function ViewLeaving()
    {
        return view('pages/promethee/leaving');
    }

    public function ViewPreferensi()
    {
        $showpreferensi = $this->Deviasi();
        // dd($showpreferensi);
        return view('pages/promethee/indekspref', ['showpreferensi' => $showpreferensi]);
    }

    public function Preferensi()
    {
        $d[] = $this->Deviasi();
        $preferensi = array();
        // dd($d);
        foreach ($d as $d) {
            for ($no = 0; $no < count($d); $no++) {
                if ($d[$no]['kriteria'] == "Usual") {
                    if ($d[$no]['nilai'] == 0) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 0
                        ];
                    } else {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 1
                        ];
                    }
                } elseif ($d[$no]['kriteria'] == "Quasi") {
                    if (-$d[$no]['q'] <= $d[$no]['deviasi'] and $d[$no]['deviasi'] <= $d[$no]['q']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 0
                        ];
                    } elseif ($d[$no]['deviasi'] < -$d[$no]['q'] or $d[$no]['deviasi'] > $d[$no]['q']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 1
                        ];
                    }
                } elseif ($d[$no]['kriteria'] == "Linier") {
                    if (-$d[$no]['p'] <= $d[$no]['deviasi'] and $d[$no]['deviasi'] <= $d[$no]['p']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => ($d[$no]['deviasi'] / $d[$no]['p'])
                        ];
                    } elseif ($d[$no]['deviasi'] < -$d[$no]['p'] or $d[$no]['deviasi'] > $d[$no]['p']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 1
                        ];
                    }
                } elseif ($d[$no]['kriteria'] == "Level") {
                    if ($d[$no]['deviasi'] <= $d[$no]['q']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 0
                        ];
                    } elseif ($d[$no]['q'] < $d[$no]['deviasi'] and $d[$no]['deviasi'] <= $d[$no]['p']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 0.5
                        ];
                    } elseif ($d[$no]['p'] < $d[$no]['deviasi']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 1
                        ];
                    }
                } elseif ($d[$no]['kriteria'] == "Area") {
                    if (abs($d[$no]['deviasi']) <= $d[$no]['q']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 0
                        ];
                    } elseif ($d[$no]['q'] < abs($d[$no]['deviasi']) and abs($d[$no]['deviasi']) <= $d[$no]['p']) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => (abs($d[$no]['deviasi']) - $d[$no]['q']) / ($d[$no]['p'] - $d[$no]['q'])
                        ];
                    } elseif ($d[$no]['p'] < abs($d[$no]['deviasi'])) {
                        $preferensi[$no] = [
                            "kriteria" => $d[$no]['kriteria'],
                            "tipe" => $d[$no]['tipe'],
                            "nilai" => 1
                        ];
                    }
                } elseif ($d[$no]['kriteria'] == "Gaussian") {
                    echo $no . "Ini Gaussian <br>";
                }
            }
        }
        print_r($preferensi);
    }

    public function ViewDeviasi()
    {
        for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
            $getjoins = $this->JoinEvaluasi($id);
            $showdeviasi[] = $getjoins;
        }
        // $showdeviasi = $this->Deviasi();
        // dd($showdeviasi);
        return view('pages/promethee/deviasi', ['showdeviasi' => $showdeviasi]);
    }

    public function Deviasi()
    {
        for ($id = 1; $id <= Kustom::CountKriterias(); $id++) {
            $getjoins = $this->JoinEvaluasi($id);
            $datas[] = $getjoins;
        }
        // dd($datas);
        foreach ($datas as $data => $value) {
            for ($x = 0; $x < Kustom::CountAlternatifs(); $x++) {
                for ($y = 0; $y < Kustom::CountAlternatifs(); $y++) {
                    $nilaideviasi[] = [
                        "alternatifx" => $value[$x]->alternatif,
                        "alternatify" => $value[$y]->alternatif,
                        "kriteria" => $value[$x]->kriteria,
                        "tipe" => $value[$x]->tipe,
                        "q" => $value[$x]->q,
                        "p" => $value[$x]->p,
                        "bobot" => $value[$x]->bobot,
                        "deviasi" => ($value[$x]->nilai) - ($value[$y]->nilai)
                    ];
                }
            }
        }
        // dd($nilaideviasi);
        // return $datas;
        return $nilaideviasi;
    }

    public function JoinEvaluasi($id)
    {
        $joins = DB::table('evals')->select('evals.id as id', 'alternatifs.nama as alternatif', 'kriterias.nama as kriteria', 'kriterias.q as q', 'kriterias.p as p', 'prefs.nama as tipe', 'kriterias.bobot', 'evals.nilai as nilai')->join('alternatifs', 'alternatifs.id', '=', 'evals.alternatif')->join('kriterias', 'evals.kriteria', '=', 'kriterias.id')->join('prefs', 'kriterias.pref', '=', 'prefs.id')->where('kriterias.id', '=', $id)->get();
        return $joins;
    }
}
