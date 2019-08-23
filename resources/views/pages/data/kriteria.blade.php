@extends('layout.dashboard')

@section('content')
<div class="container">
  @section('pages','data')
  @section('title','kriteria')
  <div class="card shadow rounded">
    <div class="card-body">
      <button class="btn btn-primary btn-md" type="button" data-toggle="collapse" data-target="#EditBobot"
        aria-expanded="false" aria-controls="EditBobot">
        Atur Bobot
      </button>
      <div class="collapse" id="EditBobot">
        <form action="#" method="post">
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
                <select class="form-control select2" style="width: 50%" name="minmaks" required>
                  <option value="min">Min</option>
                  <option value="maks">Maks</option>
                </select>
              </div>
              <div class="form-group">
                <h5 class="label-control">Tipe</h5>
                <select class="form-control select2" style="width: 100%" name="pref" required>
                  @foreach ($prefs as $pref)
                  <option value="{{$pref->id}}">{{$pref->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col col-md-6">
              <div class="form-group">
                <h5 class="label-control">q</h5>
                <input class="form-control" type="number" name="q">
              </div>
              <div class="form-group">
                <h5 class="label-control">p</h5>
                <input class="form-control" type="number" name="p">
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