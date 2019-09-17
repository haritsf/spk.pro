@extends('layout.dashboard')

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @elseif($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @elseif($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @section('pages','data')
    @section('title','klasifikasi')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <th>ID KLASIFIKASI</th>
                                <th>KRITERIA</th>
                                <th>NILAI</th>
                                <th>KLASIFIKASI</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($klasifikasi as $data)
                            <tr align="center">
                                <td>{{$data->id}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->nilai}}</td>
                                <td>{{$data->klasifikasi}}</td>
                                <td>
                                    <button class="btn btn-warning btn-md" data-toggle="modal"
                                        data-target="#modaledit{{$data->id}}">Edit</button>
                                    <div class="modal fade" id="modaledit{{$data->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit {{$data->nama}}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('klasifikasi.update')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        <br>
                                                        <div class="form-group">
                                                            <h5 class="label-control">nama</h5>
                                                            <input class="form-control" disabled type="text" name="nama"
                                                                value="{{$data->nama}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <h5 class="label-control">Nilai</h5>
                                                            <input disabled class="form-control" type="number"
                                                                name="nilai" value="{{$data->nilai}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <h5 class="label-control">Klasifikasi</h5>
                                                            <input autofocus class="form-control" type="text"
                                                                name="klasifikasi" value="{{$data->klasifikasi}}">
                                                        </div>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-md btn-danger"
                                                        data-dismiss="modal">Tutup</button>
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