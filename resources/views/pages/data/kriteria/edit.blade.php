{{-- {{dd($kriteria)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','kriteria')
@section('title','edit')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
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
                <select class="form-control">
                    {{-- @foreach ($kriteria as $item) --}}
                    <option name="minmaks" value="{{$kriteria->minmaks}}">{{ $kriteria->minmaks }}</option>
                    {{-- @endforeach --}}
                    {{-- <option>Option 2</option>
                                <option>Option 3</option> --}}
                </select>
                {{-- <input class="form-control" type="text" name="code" value="{{$kriteria->minmaks}}"> --}}
            </div>
            <div class="form-group">
                <h5 class="label-control">Tipe</h5>
                <select class="form-control">
                    {{-- @foreach ($kriteria as $item) --}}
                    <option name="pref" value="{{$kriteria->pref}}">{{ $kriteria->pref }}</option>
                    {{-- @endforeach --}}
                    {{-- <option>Option 2</option>
                                                <option>Option 3</option> --}}
                </select>
                {{-- <input class="form-control" type="text" name="code" value="{{$kriteria->pref}}"> --}}
            </div>
            <div class="form-group">
                <h5 class="label-control">q</h5>
                <input class="form-control" type="text" name="code" value="{{$kriteria->q}}">
            </div>
            <div class="form-group">
                <h5 class="label-control">p</h5>
                <input class="form-control" type="text" name="code" value="{{$kriteria->p}}">
            </div>
            <div class="form-group">
                <h5 class="label-control">Bobot</h5>
                <input disabled class="form-control" type="text" name="code" value="{{$kriteria->bobot}}">
            </div>
            <button class="btn btn-success btn-md disabled" type="submit" id="swal-2">Proses</button>
        </form>
    </div>
    <div class="col"></div>
</div>
@endsection