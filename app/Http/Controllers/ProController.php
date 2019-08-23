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
        $showpreferensi = $this->Preferensi();
        return view('pages/promethee/indekspref', ['showpreferensi' => $showpreferensi]);
    }

    public function Preferensi()
    {
        $countalt = Kustom::CountAlternatifs();
        $countkri = Kustom::CountKriterias();
        $totaleval = $countalt * $countalt * $countkri;

        $d = $this->Deviasi();
        // dd($d);

        $kriterias = DB::table('kriterias')->select('kriterias.id', 'kriterias.nama', 'kriterias.minmaks', 'prefs.nama as preferensi', 'kriterias.q', 'kriterias.p', 'kriterias.bobot')->join('prefs', 'prefs.id', '=', 'kriterias.pref')->get();
        foreach ($kriterias as $kriteria) {
            $id_kriteria[] = $kriteria->id;
            $nama[] = $kriteria->nama;
            $minmaks[] = $kriteria->minmaks;
            $pref[] = $kriteria->preferensi;
            $q[] = $kriteria->q;
            $p[] = $kriteria->p;
            $bobot[] = $kriteria->bobot;
        }
        // dd($kriterias);
        for ($no = 0; $no < $totaleval; $no++) {
            for ($nokriteria = 0; $nokriteria < $countkri; $nokriteria++) {
                switch ($pref[$nokriteria]) {
                    case 'Usual':
                        // 1. Usual
                        if ($d[$no] == 0) {
                            $preferensi[$no] = [0, 'Usual'];
                        } else {
                            $preferensi[$no] = [1, 'Usual'];
                        }
                        break;

                    case 'Quasi':
                        // 2. Quasi
                        if (-$q[$nokriteria] <= $d[$no] and $d[$no] <= $q[$nokriteria]) {
                            $preferensi[$no] = [0, 'Quasi'];
                        } elseif ($d[$no] < -$q[$nokriteria] or $d[$no] > $q[$nokriteria]) {
                            $preferensi[$no] = [1, 'Quasi'];
                        }
                        break;

                    case 'Linier':
                        // 3. Linier
                        if (-$p[$nokriteria] <= $d[$no] and $d[$no] <= $p[$nokriteria]) {
                            $preferensi[$no] = [($d[$no] / $p[$nokriteria]), 'Linier'];
                        } elseif ($d[$no] < -$p[$nokriteria] or $d[$no] > $p[$nokriteria]) {
                            $preferensi[$no] = [1, 'Linier'];
                        }
                        break;

                    case 'Level':
                        // 4. Level
                        if ($d[$no] <= $q[$nokriteria]) {
                            $preferensi[$no] = [0, 'LQ'];
                        } elseif ($q[$nokriteria] < $d[$no] and $d[$no] <= $p[$nokriteria]) {
                            $preferensi[$no] = [0.5, 'LQ'];
                        } elseif ($p[$nokriteria] < $d[$no]) {
                            $preferensi[$no] = [1, 'LQ'];
                        }
                        break;

                    case 'Area':
                        // 5. Area
                        if (abs($d[$no]) <= $q[$nokriteria]) {
                            $preferensi[$no] = [0, 'Area'];
                        } elseif ($q[$nokriteria] < abs($d[$no]) and abs($d[$no]) <= $p[$nokriteria]) {
                            $preferensi[$no] = [(abs($d[$no]) - $q[$nokriteria]) / ($p[$nokriteria] - $q[$nokriteria]), 'Area'];
                        } elseif ($p[$nokriteria] < abs($d[$no])) {
                            $preferensi[$no] = [1, 'Area'];
                        }
                        break;

                    case 'Gaussian':
                        // 6. Gaussian
                        echo 'Preferensi Gaussian<br>';
                        break;
                }
            }
        }

        $output = compact("kriteria", "preferensi");
        // dd($preferensi);
        return $preferensi;
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
                    $nilaideviasi[] = ($value[$x]->nilai) - ($value[$y]->nilai);
                }
            }
        }
        // dd($nilaideviasi);
        // return $datas;
        return $nilaideviasi;
    }

    public function JoinEvaluasi($id)
    {
        $joins = DB::table('evals')->select('evals.id as id', 'alternatifs.nama as alternatif', 'kriterias.nama as kriteria', 'kriterias.bobot', 'evals.nilai as nilai')->join('alternatifs', 'alternatifs.id', '=', 'evals.alternatif')->join('kriterias', 'evals.kriteria', '=', 'kriterias.id')->where('kriterias.id', '=', $id)->get();
        return $joins;
    }
}
