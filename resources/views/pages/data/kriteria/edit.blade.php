{{-- {{dd($kriteria)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','kriteria')
@section('title','edit')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card shadow rounded">
            <div class="card-body">
                <form action="" method="post" class="form">
                    @csrf
                    <br>
                    <div class="form-group">
                        <h5 class="label-control">ID Kriteria</h5>
                        <input class="form-control" disabled type="number" name="nama" value="{{$kriteria->id}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Nama</h5>
                        <input class="form-control" type="text" name="nama" value="{{$kriteria->nama}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Parameter</h5>
                        <select class="form-control select2" style="width: 50%" name="minmaks" required>
                            <option name="minmaks" value="{{$kriteria->minmaks}}">{{ $kriteria->minmaks }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Tipe</h5>
                        <select class="form-control select2" style="width: 100%" name="prefs" required>
                            <option name="pref" value="{{$kriteria->pref}}">{{ $kriteria->pref }}</option>
                            @foreach ($prefs as $pref)
                            <option name="pref" value="{{$pref->id}}">{{$pref->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">q</h5>
                        <input class="form-control" type="number" name="q" value="{{$kriteria->q}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">p</h5>
                        <input class="form-control" type="number" name="p" value="{{$kriteria->p}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Bobot</h5>
                        <input disabled class="form-control" type="number" name="bobot" value="{{$kriteria->bobot}}">
                    </div>
                    <button class="btn btn-success btn-md disabled" type="submit" id="swal-2">Proses</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
@endsection