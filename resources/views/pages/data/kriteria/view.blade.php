@php
// foreach ($datas as $data => $value) {
// var_dump($value);
// }
// die;
// dd($datas);
@endphp
@extends('layout.dashboard')
@section('content')
<div class="container">
    @section('pages','kriteria')
    @section('title',$getkriteria->nama)

    {{-- <div class="card">
        <div class="card-body">
            <button class="btn btn-primary btn-md" type="button" data-toggle="collapse" data-target="#collapseTambah"
                aria-expanded="false" aria-controls="collapseTambah">
                Tambah
            </button>
            <button class="btn btn-primary" id="swal-2">Launch</button>
            <div class="collapse" id="collapseTambah">
                <form action="{{url('/simpankecamatan')}}" method="post">
    @csrf
    <br>
    <div class="form-group">
        <h5 class="label-control">Nilai</h5>
        <select class="form-control selectric" name="nilai" required="">
            <option value="1">Bodeh</option>
            <option value="2">Ulujami</option>
            <option value="3">Comal</option>
            <option value="4">Ampelgading</option>
        </select>
    </div>
    <button class="btn btn-success btn-md" type="submit" id="swal-2">Proses</button>
    </form>
</div>
</div>
</div> --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>ID</th>
                            <th>Kecamatan</th>
                            <th>Nilai</th>
                            <th>Klasifikasi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($datas as $data)
                        <tr align="center">
                            <td>{{ $data->alternatif }}</td>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->nilai }}</td>
                            <td>{{ $data->klasifikasi }}</td>
                            <td>
                                <button class="btn btn-warning btn-md" data-toggle="modal" data-target="#modaledit{{$data->id}}">Edit</button>
                                <div class="modal fade" id="modaledit{{$data->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit {{$getkriteria->nama}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    @csrf
                                                    <br>
                                                    <div class="form-group">
                                                        <h5 class="label-control">Kecamatan</h5>
                                                        <input class="form-control" disabled type="text" name="nama" value="{{$data->nama}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <h5 class="label-control">Nilai</h5>
                                                        <input autofocus class="form-control" type="number" name="nilai" value="{{$data->nilai}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <h5 class="label-control">Klasifikasi</h5>
                                                        <input disabled class="form-control" type="text" value="{{$data->klasifikasi}}">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer bg-whitesmoke br">
                                                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Tutup</button>
                                                <button disabled type="button" class="btn btn-md btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
