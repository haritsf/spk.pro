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
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function Login()
    // {
    //     return view('pages/admin/login');
    // }

    // public function Logout()
    // {
    //     $session = array(
    //         'nama'  => session('nama'),
    //         'user'  => session('user'),
    //     );
    //     $hancur = session()->flush();

    //     Session::flush();
    //     return redirect(route('landing'));
    //     return view('landing');
    // }

    public function dashboard()
    {
        return view('layout/dashboard');
    }

    public function home()
    {
        $countalternatifs = Alternatif::count();
        $countkriterias = Kriteria::count();
        // $getall = Alternatif::with('evals','kriteria')->get();
        return view(
            'pages/admin/home',
            ['countalternatifs' => $countalternatifs],
            ['countkriterias' => $countkriterias]
        );
    }

    public function pemalang()
    {
        return view('pages/admin/pemalang');
    }

    public function kecamatanread()
    {
        $alternatifs = Alternatif::all();
        return view('pages/data/kecamatan/view', ['alternatifs' => $alternatifs]);
    }

    public function kriteriaread()
    {
        $kriterias = Kriteria::all();
        return view('pages/data/kriteria', ['kriterias' => $kriterias]);
    }

    public function preferensi()
    {
        $data = [
            'prefs' => DB::table('prefs')->get()
        ];
        return view('pages/data/preferensi', $data);
    }

    public function analisa()
    {
        return view('pages/admin/analisa');
    }

    public function pengguna()
    {
        $getpenggunas = User::get();
        return view(
            'pages/admin/users',
            ['getpenggunas' => $getpenggunas]
        );
    }

    // <------------------------------------------------------->

    public function kecamatancreate(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $kode = $request->kode;
        Alternatif::create($request->all());
        return redirect()->back()->with('success', 'Kecamatan Berhasil di Tambah');
    }

    public function kecamatanedit($id)
    {
        $alternatif = Alternatif::find($id);
        // dd($alternatif);
        return view('pages/data/kecamatan/edit', ['alternatif' => $alternatif]);
    }

    public function kecamatanupdate(Request $request)
    {
        DB::table('alternatifs')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);
        return redirect(route('kecamatan.read'))->with('info', 'Kecamatan Berhasil di Update');
    }

    public function kecamatandelete($id)
    {
        DB::table('alternatifs')->where('id', $id)->delete();
        return redirect()->back()->with('danger', 'Kecamatan Berhasil di Hapus');
    }

    // <------------------------------------------------------->

    public function kriteriaview($id)
    {
        // $datas = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->where('evals.kriteria', '=', $id)->get();
        $datas = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai', 'klasifikasis.klasifikasi')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->join('klasifikasis', 'evals.nilai', '=', 'klasifikasis.nilai')->where('evals.kriteria', '=', $id)->get();
        // dd($datas);

        $getkriteria = DB::table('kriterias')->find($id);
        return view('pages/data/kriteria/view', ['datas' => $datas], ['getkriteria' => $getkriteria]);
    }

    public function kriteriaedit($id)
    {
        $kriteria = Kriteria::find($id);
        // dd($kriteria);
        return view('pages/data/kriteria/edit', ['kriteria' => $kriteria]);
    }
}
