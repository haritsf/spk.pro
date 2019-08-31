<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Kustom;
use App\Kriteria;
use App\Alternatif;
use App\Evaluasi;
use App\Klasifikasi;
use App\Pengguna;
use App\Preferensi;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Dashboard()
    {
        return view('layout/dashboard');
    }

    public function Home()
    {
        $getnet = Kustom::Net();
        $countall = array();
        $countalternatifs = Alternatif::count();
        $countkriterias = Kriteria::count();
        array_push($countall, $countalternatifs, $countkriterias);
        // $getall = Alternatif::with('evals','kriteria')->get();
        return view(
            'pages/admin/home',
            ['countalternatifs' => $countall[0]],
            // ['countkriterias' => $countall[1]],
            ['getnet' => $getnet]
        );
    }

    public function Pemalang()
    {
        return view('pages/admin/pemalang');
    }

    public function KecamatanRead()
    {
        $alternatifs = Alternatif::all();
        return view('pages/data/kecamatan/view', ['alternatifs' => $alternatifs]);
    }

    public function KriteriaRead()
    {
        // $kriterias = Kriteria::all();
        $kriterias = DB::table('kriterias')->select('kriterias.id', 'kriterias.nama', 'kriterias.minmaks', 'prefs.nama as pref', 'kriterias.q', 'kriterias.p', 'kriterias.bobot')->join('prefs', 'prefs.id', '=', 'kriterias.pref')->get();
        $prefs = Preferensi::all();
        // dd($kriterias);
        return view('pages/data/kriteria', ['kriterias' => $kriterias], ['prefs' => $prefs]);
    }

    public function Preferensi()
    {
        $data = [
            'prefs' => DB::table('prefs')->get()
        ];
        return view('pages/data/preferensi', $data);
    }

    public function Analisa()
    {
        return view('pages/admin/analisa');
    }

    public function Klasifikasi()
    {
        // $klasifikasi = Klasifikasi::all();
        $klasifikasi = DB::table('klasifikasis')->select('klasifikasis.id', 'kriterias.nama', 'klasifikasis.nilai', 'klasifikasis.klasifikasi')->join('kriterias', 'klasifikasis.kriteria', '=', 'kriterias.id')->get();
        // dd($klasifikasi);
        return view('pages/data/klasifikasi', ['klasifikasi' => $klasifikasi]);
    }

    public function Pengguna()
    {
        $datas = User::get();
        return view('pages/admin/users', compact('datas'));
    }

    public function CreatePengguna(Request $request)
    {
        $data = new User();
        $data->username = $request->username;
        $data->password = Hash::make($request->password);
        $data->alias = $request->alias;
        $data->role = $request->role;
        $data->save();
        return back()->with('success', 'User berhasil dibuat');
    }

    public function EditPengguna($id)
    {
        $data = User::find($id);
        return view('pages.admin.editusers', compact('data'));
    }

    public function UpdatePengguna(Request $request)
    {
        $update = User::find($request->id);
        $update->username = $request->username;
        $update->alias = $request->alias;
        $update->role = $request->role;
        $update->save();
        return redirect(route('pengguna.read'))->with('success', 'User berhasil dibuat');
    }

    public function DeletePengguna(Request $request)
    {
        $data = User::find($request->id);
        $data->delete();
        return back()->with('success', 'User berhasil dihapus');
    }

    public function KecamatanCreate(Request $request)
    {
        DB::table('alternatifs')->insert([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);

        $getid = DB::table('alternatifs')->orderBy('id', 'desc')->first();
        // dd($getid->id);

        $panjang = count($request->kriteria) + 1;
        for ($i = 1; $i < $panjang; $i++) {
            DB::table('evals')->insert([
                'alternatif' => $getid->id,
                'kriteria' => "$i",
                'nilai' => $request->kriteria[$i - 1],
                'submit_by' => Auth::user()->id
            ]);
        }

        return redirect()->back()->with('success', 'Kecamatan Berhasil di Tambah');
    }

    public function KecamatanEdit($id)
    {
        $alternatif = Alternatif::find($id);
        // dd($alternatif);
        return view('pages/data/kecamatan/edit', ['alternatif' => $alternatif]);
    }

    public function KecamatanUpdate(Request $request)
    {
        DB::table('alternatifs')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);
        return redirect(route('kecamatan.read'))->with('info', 'Kecamatan Berhasil di Update');
    }

    public function KecamatanDelete($id)
    {
        DB::table('alternatifs')->where('id', $id)->delete();
        DB::table('evals')->where('alternatif', $id)->delete();
        return redirect()->back()->with('danger', 'Kecamatan Berhasil di Hapus');
    }

    public function KriteriaView($id)
    {
        $datas = DB::table('alternatifs')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai')->join('evals', 'alternatifs.id', '=', 'evals.alternatif')->where('evals.kriteria', '=', $id)->get();
        // $datas = DB::table('evals')->select('alternatifs.id', 'alternatifs.nama', 'evals.id', 'evals.alternatif', 'evals.kriteria', 'evals.nilai', 'klasifikasis.klasifikasi')->join('alternatifs', 'alternatifs.id', '=', 'evals.alternatif')->join('klasifikasis', 'evals.nilai', '=', 'klasifikasis.nilai')->where('evals.kriteria', '=', $id)->get(); 
        // dd($datas);

        $getkriteria = DB::table('kriterias')->find($id);
        return view('pages/data/kriteria/view', ['datas' => $datas], ['getkriteria' => $getkriteria]);
    }

    public function KriteriaEdit($id)
    {
        $kriteria = Kriteria::find($id);
        $prefs = Preferensi::all();
        // dd($kriteria);
        return view('pages/data/kriteria/edit', ['kriteria' => $kriteria], ['prefs' => $prefs]);
    }

    public function KriteriaUpdate(Request $request)
    {
        // dd($request->all());
        $update = Evaluasi::find($request->id);
        $update->nilai = $request->nilai;
        $update->save();
        return back()->with('success', 'Nilai berhasil di Update');
    }

    public function EditProfile($id)
    {
        $data = User::find($id);
        return view('pages.profile', compact('data'));
    }

    public function UpdateProfile(Request $request)
    {
        $update = User::find($request->id);
        $update->username = $request->username;
        $update->alias = $request->alias;
        // $update->role = $request->role;
        $update->save();
        return back()->with('success', 'Profile berhasil diupdate');
    }
}
