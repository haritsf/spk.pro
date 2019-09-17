@extends('layout.dashboard')

@section('content')
<div class="container">
  @section('pages','data')
  @section('title','kriteria')
  
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

  <div class="row">
    <div class="col-12">
      <div class="card shadow rounded">
        <div class="card-body">
          <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
            <thead>
              <tr align="center">
                <th>ID</th>
                <th>NAMA</th>
                <th>PARAMETER</th>
                <th>TIPE</th>
                <th>q</th>
                <th>p</th>
                <th>BOBOT</th>
                <th>OPSI</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($kriterias as $data)
              <tr align="center">
                <td>{{ $data->id }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->minmaks }}</td>
                <td>{{ $data->pref }}</td>
                <td>{{ $data->q }}</td>
                <td>{{ $data->p }}</td>
                <td>{{ $data->bobot }}%</td>
                <td>
                  <a class="btn btn-warning btn-md" href="{{route('kriteria.edit',$data->id)}}">Edit</a>
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