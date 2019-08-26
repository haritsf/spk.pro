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

    public function Uwu()
    {
        $countalt = Kustom::CountAlternatifs();
        $countkri = Kustom::CountKriterias();
        $totaleval = $countalt * $countalt * $countkri;
        $pref = [];
        $d = $this->Deviasi();
        // dd($d);

        $kriterias = DB::table('kriterias')->select('kriterias.id', 'kriterias.nama', 'kriterias.minmaks', 'prefs.nama as preferensi', 'kriterias.q', 'kriterias.p', 'kriterias.bobot')->join('prefs', 'prefs.id', '=', 'kriterias.pref')->get();

        dd($this->pref($kriterias)->nama);
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
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 0
                            ];
                        } else {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 1
                            ];
                        }
                        break;

                    case 'Quasi':
                        // 2. Quasi
                        if (-$q[$nokriteria] <= $d[$no] and $d[$no] <= $q[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 0
                            ];
                        } elseif ($d[$no] < -$q[$nokriteria] or $d[$no] > $q[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 1
                            ];
                        }
                        break;

                    case 'Linier':
                        // 3. Linier
                        if (-$p[$nokriteria] <= $d[$no] and $d[$no] <= $p[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => ($d[$no] / $p[$nokriteria])
                            ];
                        } elseif ($d[$no] < -$p[$nokriteria] or $d[$no] > $p[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 1
                            ];
                        }
                        break;

                    case 'Level':
                        // 4. Level
                        if ($d[$no] <= $q[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 0
                            ];
                        } elseif ($q[$nokriteria] < $d[$no] and $d[$no] <= $p[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 0.5
                            ];
                        } elseif ($p[$nokriteria] < $d[$no]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 1
                            ];
                        }
                        break;

                    case 'Area':
                        // 5. Area
                        if (abs($d[$no]) <= $q[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 0
                            ];
                        } elseif ($q[$nokriteria] < abs($d[$no]) and abs($d[$no]) <= $p[$nokriteria]) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => (abs($d[$no]) - $q[$nokriteria]) / ($p[$nokriteria] - $q[$nokriteria])
                            ];
                        } elseif ($p[$nokriteria] < abs($d[$no])) {
                            $preferensi[$no] = [
                                "nama" => $nama[$nokriteria],
                                "tipe" => $pref[$nokriteria],
                                "nilai" => 1
                            ];
                        }
                        break;

                    case 'Gaussian':
                        // 6. Gaussian
                        echo 'Preferensi Gaussian<br>';
                        break;
                }
            }
        }
        // dd($kriteria->preferensi);

        // $output = compact("kriteria", "preferensi");
        // dd($preferensi);
        // return $preferensi;
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

    public function BackupPreferensi()
    {

        $d[] = $this->Deviasi();
        $preferensi = array();
        // dd($d);
        foreach ($d as $d) {
            for ($no = 0; $no < count($d); $no++) {
                switch ($d[$no]['kriteria']) {
                    case 'Usual':
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
                        // return $preferensi[$no];
                        break;

                    case 'Quasi':
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
                        // return $preferensi[$no];
                        break;

                    case 'Linier':
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
                        // return $preferensi[$no];
                        break;

                    case 'Level':
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
                                "nilai" => 0.5
                            ];
                        } elseif ($d[$no]['p'] < abs($d[$no]['deviasi'])) {
                            $preferensi[$no] = [
                                "kriteria" => $d[$no]['kriteria'],
                                "tipe" => $d[$no]['tipe'],
                                "nilai" => 1
                            ];
                        }
                        // return $preferensi[$no];
                        break;

                    case "Area":
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
                        // return $preferensi[$no];
                        break;

                    case "Gaussian":
                        echo "Ini Gaussian";
                        break;
                }
            }
        }
        dd($preferensi);
    }
    

}
