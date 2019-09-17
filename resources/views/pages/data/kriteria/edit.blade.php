@extends('layout.dashboard')

@section('content')

@section('pages','kriteria')
@section('title','edit')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card shadow rounded">
            <div class="card-body">
                <form action="{{route('kriteria.update', $data['kriteria']->id)}}" method="POST" class="form">
                    {{ csrf_field() }}
                    <br>
                    <div class="form-group">
                        <h5 class="label-control">ID Kriteria</h5>
                        <input class="form-control" disabled type="number" name="id" value="{{$data['kriteria']->id}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Nama</h5>
                        <input class="form-control" type="text" name="nama" value="{{$data['kriteria']->nama}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Parameter</h5>
                        <select class="form-control select2" style="width: 50%" name="minmaks"
                            value="{{$data['kriteria']->minmaks}}" data-minimum-results-for-search="-1" required>
                            <option name="minmaks" value="{{$data['kriteria']->minmaks}}">{{$data['kriteria']->minmaks}}
                            </option>
                            @if ($data['kriteria']->minmaks == 'min')
                            <option value="maks">maks</option>
                            @elseif ($data['kriteria']->minmaks != 'min')
                            <option value="min">min</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Tipe</h5>
                        <select class="form-control select2" style="width: 100%" name="pref" value="{{$data['kriteria']->pref}}"
                            data-minimum-results-for-search="-1" required>
                            <option name="pref" value="{{$data['kriteria']->pref}}">
                                {{$prefs[($data['kriteria']->pref)-1]->nama}}</option>
                            @foreach ($prefs as $pref)
                            <option name="pref" value="{{$pref->id}}">{{$pref->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">q</h5>
                        <input class="form-control" type="number" name="q" value="{{$data['kriteria']->q}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">p</h5>
                        <input class="form-control" type="number" name="p" value="{{$data['kriteria']->p}}">
                    </div>
                    <div class="form-group">
                        <h5 class="label-control">Bobot</h5>
                        <input disabled class="form-control" type="number" name="bobot"
                            value="{{$data['kriteria']->bobot}}">
                    </div>
                    <button class="btn btn-success btn-md" type="submit">Proses</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
@endsection