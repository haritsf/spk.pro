{{-- {{dd($alternatif)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','kecamatan')
@section('title','edit')
<div class="row">
  <div class="col"></div>
  <div class="col-6">
    <form action="#" method="post" class="form">
    {{-- <form action="{{route('kecamatan.update')}}" method="post" class="form"> --}}
      @csrf
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
        <input class="form-control" type="text" name="code" value="{{$alternatif->kode}}">
      </div>
      <button class="btn btn-success btn-md" type="submit" id="swal-2">Proses</button>
    </form>
  </div>
  <div class="col"></div>
</div>
@endsection