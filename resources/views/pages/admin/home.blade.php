{{-- {{dd($getnet)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','admin')
@section('title','home')

<section class="section">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-statistic-1 shadow rounded">
        <div class="card-icon bg-primary">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Evaluasi</h4>
          </div>
          <div class="card-body">
            {{ $countalternatifs*6 }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-statistic-1 shadow rounded">
        <div class="card-icon bg-primary">
          <i class="far fa-map"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Kecamatan</h4>
          </div>
          <div class="card-body">
            {{ $countalternatifs }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-statistic-1 shadow rounded">
        <div class="card-icon bg-primary">
          <i class="far fa-edit"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Kriteria</h4>
          </div>
          <div class="card-body">
            {{ 6 }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary shadow rounded">
        <div class="card-body">
          <h2>
            <center>Ranking</center>
          </h2>
          <table width="100%" class="table table-striped table-bordered table-hover table-md" id="Net">
            <thead>
              <tr align="center">
                <th>Rank</th>
                <th>Netflow</th>
                <th>Kecamatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($getnet as $net => $value)
              <tr align="center">
                <td>{{$value['rank']}}</td>
                <td>{{number_format($value['net'], 2)}}</td>
                <td>{{$value['kecamatan']}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-8 ml-auto mr-auto">
      <div class="card shadow rounded">
        <div class="card-body">
          <iframe width="100%" height="720" frameborder="0"
            src="https://haritsf.carto.com/builder/fa5de34c-50bb-4906-9ce0-6de4809fb349/embed" allowfullscreen
            webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection