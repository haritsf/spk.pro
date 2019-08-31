<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Kustom;
use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;

class ClientController extends Controller
{
    public function Landing()
    {
        $countalternatifs = Kustom::CountAlternatifs();
        $countkriterias = Kustom::CountKriterias();
        return view('landing', ['countalternatifs' => $countalternatifs], ['countkriterias' => $countkriterias]);
    }

    public function Data()
    {
        $cobajoins = DB::table('evals')->select('alternatifs.nama as kecamatan', 'kriterias.nama as kriteria', 'evals.nilai as nilai', 'klasifikasis.klasifikasi as klasifikasi')->join('klasifikasis', 'evals.nilai', '=', 'klasifikasis.nilai')->join('alternatifs', 'evals.alternatif', '=', 'alternatifs.id')->join('kriterias', 'evals.kriteria', '=', 'kriterias.id')->get();
        // dd($cobajoins);
        $getalternatifs = Alternatif::get();
        $getkriterias = Kriteria::get();
        $getevals = Evaluasi::get();
        $getall = compact("getalternatifs", "getkriterias", "getevals");
        // dd($getall);
        return view(
            '/pages/client/data',
            ['getalternatifs' => $getalternatifs],
            ['getkriterias' => $getkriterias]
        );
    }

    public function Analisa()
    {
        $arrayall = Kustom::LeavingEntering();
        $arraynet = Kustom::Net();
        return view(
            'pages/client/analisa',
            ['tip' => $arrayall[0]],
            ['arraynet' => $arraynet]
        );
    }

    public function Pemalang()
    {
        return view('pages/client/pemalang');
    }
}
