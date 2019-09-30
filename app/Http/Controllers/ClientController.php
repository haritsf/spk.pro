<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Kustom;
use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;
use App\Klasifikasi;
use App\Preferensi;

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
        $datas['alternatifs'] = Alternatif::get();
        $datas['kriterias'] = Kriteria::get();
        $datas['klasifikasis'] = Klasifikasi::get();
        $datas['prefs'] = Preferensi::get();
        return view('/pages/client/data', ['datas' => $datas]);
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
