{{-- {{dd($alternatif)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','kecamatan')
@section('title','edit')
<div class="row">
  <div class="col"></div>
  <div class="col-6">
    <div class="card shadow rounded">
      <div class="card-body">
        <form action="{{route('kecamatan.update', $alternatif->id)}}" method="POST" class="form">
          {{ csrf_field() }}
          <br>
          <div class="form-group">
            <h5 class="label-control">ID Kecamatan</h5>
            <input class="form-control" disabled type="number" name="nama" value="{{$alternatif->id}}">
          </div>
          <div class="form-group">
            <h5 class="label-control">Nama Kecamatan</h5>
            <input class="form-control" type="text" name="nama" value="{{$alternatif->nama}}">
          </div>
          <div class="form-group">
            <h5 class="label-control">Kode</h5>
            <input class="form-control" type="text" name="kode" value="{{$alternatif->kode}}">
          </div>
          <button class="btn btn-success btn-md" type="submit">Proses</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>
@endsection