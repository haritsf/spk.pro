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
    public function landing()
    {
        return view('landing');
    }

    public function data()
    {
        $getalternatifs = Alternatif::get();
        $getkriterias = Kriteria::get();
        // dd($getevals);
        return view(
            '/pages/client/data',
            ['getalternatifs' => $getalternatifs],
            ['getkriterias' => $getkriterias]
        );
    }

    public function analisa()
    {
        return view('pages/client/analisa');
    }

    public function pemalang()
    {
        return view('pages/client/pemalang');
    }
}
