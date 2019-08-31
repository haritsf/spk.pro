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
        $arraynet = $this->Net();
        // dd($arraynet);
        return view('pages/promethee/net', ['arraynet' => $arraynet]);
    }

    public function Net()
    {
        $arrayall = $this->LeavingEntering();
        $namaalternatifs = Kustom::NamaAlternatifs();
        $arraynet = array();
        $no = 1;
        for ($n = 0; $n < Kustom::CountAlternatifs(); $n++) {
            $net = $arrayall[2][$n] - $arrayall[4][$n];
            $temp = [
                'kecamatan' => $namaalternatifs[$n]['nama'],
                'net' => $net
            ];
            $no++;
            array_push($arraynet, $temp);
        }
        // dd($arraynet);
        return $arraynet;
    }

    public function ViewLeavingEntering()
    {
        $arrayall = $this->LeavingEntering();
        // $pref = $this->Preferensi();
        // dd($arrayall);
        return view(
            'pages/promethee/leavingentering',
            ['tip' => $arrayall[0]],
            ['tlf' => $arrayall[1]],
            ['lf' => $arrayall[2]],
            ['tle' => $arrayall[3]],
            ['le' => $arrayall[4]]
        );
    }

    public function LeavingEntering()
    {
        // define("MAX_COLS", Kustom::CountAlternatifs());

        $pref = $this->Preferensi();
        $pref = $pref[1];

        $hasil = array(array());

        $cols = 0;
        $rows = 0;
        for ($i = 0; $i < count($pref); $i++) {
            array_push($hasil[$rows], $pref[$i]);

            $cols += 1;
            if ($cols == Kustom::CountAlternatifs()) {
                if (!($i == count($pref) - 1)) {
                    array_push($hasil, array());
                }
                $rows += 1;
                $cols = 0;
            }
        }
        // dd($hasil);

        $arraytlf = $arrayleaving = $arraytef = $arrayentering = array();
        for ($y = 0; $y < Kustom::CountAlternatifs(); $y++) {
            $tlf = $tef = 0;
            for ($x = 0; $x < Kustom::CountAlternatifs(); $x++) {
                $tlf = $tlf + $hasil[$y][$x]['value'];
                $tef = $tef + $hasil[$x][$y]['value'];
            }
            array_push($arraytlf, number_format($tlf, 2));
            array_push($arraytef, number_format($tef, 2));
            $leaving = $tlf / (Kustom::CountAlternatifs() - 1);
            $entering = $tef / (Kustom::CountAlternatifs() - 1);
            array_push($arrayleaving, number_format($leaving, 2));
            array_push($arrayentering, number_format($entering, 2));
        }
        // dd($arraytef);
        // dd($arrayentering);

        $arrayall = $arraynet = array();
        $no = 1;
        for ($n = 0; $n < Kustom::CountAlternatifs(); $n++) {
            $net = $arrayleaving[$n] - $arrayentering[$n];
            $temp = [
                'kecamatan' => $no,
                'net' => $net
            ];
            $no++;
            array_push($arraynet, $temp);
        }
        // dd($arraynet);
        array_push($arrayall, $hasil, $arraytlf, $arrayleaving, $arraytef, $arrayentering);
        // dd($arrayall);
        return $arrayall;
    }

    public function ViewPreferensi()
    {
        $pref = $this->Preferensi();
        // dd($pref[1]);
        return view('pages/promethee/indekspref', ['pref' => $pref[0]], ['tip' => $pref[1]]);
    }

    public function Preferensi()
    {
        $d[] = $this->Deviasi();
        $preferensi = $pref = array();
        // dd($d);
        foreach ($d as $d) {
            for ($no = 0; $no < count($d); $no++) {
                // dd($d[$no]['tipe']);
                if ($d[$no]['tipe'] == 'Usual') {
                    if ($d[$no]['deviasi'] == 0) {
                        $nilai = 0;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } else {
                        $nilai = 1;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    }
                } elseif ($d[$no]['tipe'] == 'Quasi') {
                    if (-$d[$no]['q'] <= $d[$no]['deviasi'] and $d[$no]['deviasi'] <= $d[$no]['q']) {
                        $nilai = 0;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['deviasi'] < -$d[$no]['q'] or $d[$no]['deviasi'] > $d[$no]['q']) {
                        $nilai = 1;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    }
                } elseif ($d[$no]['tipe'] == 'Linier') {
                    if (-$d[$no]['p'] <= $d[$no]['deviasi'] and $d[$no]['deviasi'] <= $d[$no]['p']) {
                        $nilai = ($d[$no]['deviasi'] / $d[$no]['p']);
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['deviasi'] < -$d[$no]['p'] or $d[$no]['deviasi'] > $d[$no]['p']) {
                        $nilai = 1;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    }
                } elseif ($d[$no]['tipe'] == 'Level') {
                    if (abs($d[$no]['deviasi']) <= $d[$no]['q']) {
                        $nilai = 0;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['q'] < abs($d[$no]['deviasi']) and abs($d[$no]['deviasi']) <= $d[$no]['p']) {
                        $nilai = 0.5;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['p'] < abs($d[$no]['deviasi'])) {
                        $nilai = 1;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    }
                } elseif ($d[$no]['tipe'] == 'Area') {
                    if (abs($d[$no]['deviasi']) <= $d[$no]['q']) {
                        $nilai = 0;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['q'] < abs($d[$no]['deviasi']) and abs($d[$no]['deviasi']) <= $d[$no]['p']) {
                        $nilai = (abs($d[$no]['deviasi']) - $d[$no]['q']) / ($d[$no]['p'] - $d[$no]['q']);
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    } elseif ($d[$no]['p'] < abs($d[$no]['deviasi'])) {
                        $nilai = 1;
                        $pref = [
                            'altx' => $d[$no]['alternatifx'],
                            'alty' => $d[$no]['alternatify'],
                            'kriteria' => $d[$no]['kriteria'],
                            'tipe' => $d[$no]['tipe'],
                            'nilai' => $nilai,
                            'ip' => $nilai * $d[$no]['bobot']
                        ];
                    }
                } elseif ($d[$no]['tipe'] == 'Gaussian') {
                    echo $no . "Ini Gaussian <br>";
                }
                array_push($preferensi, $pref);
            }
        }

        // dd($preferensi);

        $criterias = array(
            "kelerengan" => array(),
            "penggunaan lahan" => array(),
            "rawan bencana longsor" => array(),
            "curah hujan" => array(),
            "cadangan air tanah" => array(),
            "jenis tanah" => array()
        );

        foreach ($preferensi as $p) {
            // dd($p);
            if (strtolower($p['kriteria']) == 'kelerengan') {
                array_push($criterias["kelerengan"], $p);
            } elseif (strtolower($p['kriteria']) == 'penggunaan lahan') {
                array_push($criterias["penggunaan lahan"], $p);
            } elseif (strtolower($p['kriteria']) == 'rawan bencana longsor') {
                array_push($criterias["rawan bencana longsor"], $p);
            } elseif (strtolower($p['kriteria']) == 'curah hujan') {
                array_push($criterias["curah hujan"], $p);
            } elseif (strtolower($p['kriteria']) == 'cadangan air tanah') {
                array_push($criterias["cadangan air tanah"], $p);
            } elseif (strtolower($p['kriteria']) == 'jenis tanah') {
                array_push($criterias["jenis tanah"], $p);
            }
        }

        $hasil = array();

        for ($i = 0; $i < count($criterias['kelerengan']); $i++) {
            // dd($criterias['kelerengan']);
            $calculation = $criterias['kelerengan'][$i]['ip'] + $criterias['penggunaan lahan'][$i]['ip'] + $criterias['rawan bencana longsor'][$i]['ip'] + $criterias['curah hujan'][$i]['ip'] + $criterias['cadangan air tanah'][$i]['ip'] + $criterias['jenis tanah'][$i]['ip'];
            $temp = array(
                "altx" => $criterias['kelerengan'][$i]['altx'],
                "alty" => $criterias['kelerengan'][$i]['alty'],
                "value" => $calculation
            );
            array_push($hasil, $temp);
        }

        $arrays = array();
        array_push($arrays, $preferensi, $hasil);

        return $arrays;
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
                        'alternatifx' => $value[$x]->alternatif,
                        'alternatify' => $value[$y]->alternatif,
                        'kriteria' => $value[$x]->kriteria,
                        'tipe' => $value[$x]->tipe,
                        "q" => $value[$x]->q,
                        "p" => $value[$x]->p,
                        'bobot' => $value[$x]->bobot,
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
