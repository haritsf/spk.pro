@extends('layout.dashboard')

@section('content')
{{-- {{ dd($alternatifs)}} --}}

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
  @section('title','kecamatan')
  <div class="card shadow rounded">
    <div class="card-body">
      <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseTambah"
        aria-expanded="false" aria-controls="collapseTambah">
        Tambah
      </button>
      {{-- <button class="btn btn-primary" id="toastr-4">Launch</button> --}}
      <div class="collapse" id="collapseTambah">
        <form action="{{route('kecamatan.create')}}" method="post" class="form">
          @csrf
          <br>
          <div class="form-group">
            <h5 class="label-control">Nama Kecamatan</h5>
            <input class="form-control" type="text" name="nama" placeholder="Daerah...">
          </div>
          <div class="form-group">
            <h5 class="label-control">Kode</h5>
            <input class="form-control" type="text" name="kode" placeholder="...">
          </div>
          <button class="btn btn-success btn-md" type="submit">Proses</button>
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
                <th>ID KECAMATAN</th>
                <th>NAMA KECAMATAN</th>
                <th>KODE</th>
                <th>OPSI</th>
              </tr>
            </thead>

            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($alternatifs as $data)
              <tr align="center">
                <td>{{$no++}}</td>
                <td>{{$data->nama }}</td>
                <td>{{$data->kode }}</td>
                <td>
                  <a class="btn btn-warning btn-md" href="{{route('kecamatan.edit',$data->id)}}">Edit</a>
                  <a class="btn btn-danger btn-md" href="{{route('kecamatan.delete',$data->id)}}">Delete</a>
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
