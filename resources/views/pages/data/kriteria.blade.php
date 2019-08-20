@extends('layout.dashboard')

@section('content')
<div class="container">
  @section('pages','data')
  @section('title','kriteria')
  <div class="card shadow rounded">
    <div class="card-body">
      <button class="btn btn-primary btn-md" type="button" data-toggle="collapse" data-target="#collapseTambah"
        aria-expanded="false" aria-controls="collapseTambah">
        Tambah
      </button>
      <div class="collapse" id="collapseTambah">
        <form action="{{url('/simpankecamatan')}}" method="post">
          @csrf
          <br>
          <div class="row">
            <div class="col col-md-6">
              <div class="form-group">
                <h5 class="label-control">Nama Kriteria</h5>
                <input class="form-control" type="text" name="nama">
              </div>
              <div class="form-group">
                <h5 class="label-control">Parameter</h5>
                <select class="form-control selectric" name="min_max" required="">
                  <option value="min">min</option>
                  <option value="max">max</option>
                </select>
              </div>
              <div class="form-group">
                <h5 class="label-control">Tipe</h5>
                <select class="form-control" name="pref" required="">
                  <option value="1">Usual</option>
                  <option value="2">Linear</option>
                  <option value="3">Quasi</option>
                  <option value="4">Linear Quasi</option>
                  <option value="5">Level</option>
                  <option value="6">Gaussian</option>
                </select>
              </div>
            </div>

            <div class="col col-md-6">
              <div class="form-group">
                <h5 class="label-control">P</h5>
                <input class="form-control" type="text" name="code">
              </div>
              <div class="form-group">
                <h5 class="label-control">Q</h5>
                <input class="form-control" type="text" name="nama">
              </div>
              <div class="form-group">
                <h5 class="label-control">S</h5>
                <input class="form-control" type="text" name="code">
              </div>
              <button class="btn btn-success btn-md" type="submit">Proses</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow rounded">
        {{-- <div class="card-header">
          <h3>BalaLabaLala</h3>
        </div> --}}
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
                <td>{{ $data->bobot*100 }}%</td>
                <td>
                  <a class="btn btn-warning btn-md" href="{{route('kriteria.edit',$data->id)}}">Edit</a>
                  <a class="btn btn-danger btn-md disabled" href="">Delete</a>
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