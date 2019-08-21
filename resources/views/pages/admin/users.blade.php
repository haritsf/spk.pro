@extends('layout.dashboard')
@section('content')
<div class="container">
    @section('pages','view')
    
    @section('title','user')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div class="card shadow rounded">
        <div class="card-body">
          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseTambah"
            aria-expanded="false" aria-controls="collapseTambah">
            Tambah
          </button>
          {{-- <button class="btn btn-primary" id="toastr-4">Launch</button> --}}
          <div class="collapse" id="collapseTambah">
            <form action="{{route('pengguna.create')}}" method="post" class="form">
              @csrf
              <br>
              <div class="form-group">
                <h5 class="label-control">Username</h5>
                <input class="form-control" type="text" name="username" placeholder="Username..." required>
              </div>
              <div class="form-group">
                <h5 class="label-control">Password</h5>
                <input class="form-control" type="text" name="password" placeholder="Password..." required>
              </div>
                <div class="form-group mr-3">
                    <h5 class="label-control">Role</h5>
                    <select class="form-control select2" name="role" required>
                        <option value="Adminstrator">Adminstrator</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
              <div class="form-group">
                <h5 class="label-control">Alias</h5>
                <input class="form-control" type="text" name="alias" placeholder="Alias..." required>
              </div>
              <button class="btn btn-success btn-sm" type="submit">Proses</button>
            </form>
          </div>
        </div>
      </div>


    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>USERNAME</th>
                                <th>ALIAS</th>
                                <th>ROLE</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($datas as $data)
                            <tr align="center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->alias }}</td>
                                <td>{{ $data->role }}</td>
                                <td class="">
                                    <a class="btn btn-warning btn-md" href="{{route('pengguna.edit',$data->id)}}">Edit</a>
                                    <a class="btn btn-danger btn-md" href="" data-toggle="modal" data-target="#modaledit{{$data->id}}">Delete</a>
                                    <div class="modal fade" id="modaledit{{$data->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete {{$data->username}}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 class="label-control">Apakah anda yakin akan menghapus data {{$data->username}}?</h6>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Tutup</button>
                                                    <form action="{{route('pengguna.delete')}}" method="post">
                                                      @csrf
                                                      <input type="hidden" name="id" value="{{$data->id}}">
                                                    <button type="submit" class="btn btn-md btn-success">Simpan</button>
                                                    </form>
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
