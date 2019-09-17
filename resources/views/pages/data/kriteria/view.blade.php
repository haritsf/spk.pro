@extends('layout.dashboard')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show alert-has-icon" role="alert">
        <div class="alert-icon">
            <i class="far fa-check-circle"></i>
        </div>
        <div class="alert-body">
            <div class="alert-title" style="font-weight:normal">Sukses</div>
            {{$message}}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @section('pages','kriteria')
    @section('title',$datas['getkriteria']->nama)

    <div class="row">
        <div class="col-6">
            <div class="card shadow rounded">
                <div class="card-body">
                    <button class="btn btn-info btn-md" type="button" data-toggle="collapse" data-target="#collapseKet"
                        aria-expanded="false" aria-controls="collapseKet">Keterangan</button>
                    <div class="collapse" id="collapseKet">
                        <table width="100%" class="table table-striped table-bordered table-hover table-md" id="Ket">
                            <thead>
                                <tr align="center">
                                    <th>NILAI</th>
                                    <th>KLASIFIKASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas['getklasifikasi'] as $data)
                                @if ($data->nama == $datas['getkriteria']->nama)
                                <tr align="center">
                                    <td>{{$data->nilai}}</td>
                                    <td>{{$data->klasifikasi}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Kecamatan</th>
                                <th>Nilai</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($alternatifs as $data)
                            <tr align="center">
                                <td>{{ $data->alternatif }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nilai }}</td>
                                <td>
                                    <button class="btn btn-warning btn-md" data-toggle="modal" data-target="#modaledit{{$data->id}}">Edit</button>
                                    <div class="modal fade" id="modaledit{{$data->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit {{$datas['getkriteria']->nama}}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('evaluasi.update')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        <br>
                                                        <div class="form-group">
                                                            <h5 class="label-control">Kecamatan</h5>
                                                            <input class="form-control" disabled type="text" name="nama" value="{{$data->nama}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <h5 class="label-control">Nilai</h5>
                                                            <input autofocus class="form-control" type="number" name="nilai" value="{{$data->nilai}}">
                                                        </div>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-md btn-success">Simpan</button>
                                                </div>
                                                </form>
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