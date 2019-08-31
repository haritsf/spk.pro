{{-- {{dd($tip)}} --}}
@extends('layout.client')

@section('content')

<div class="hero-wrapper">
  <div class="hero">
    <div class="container">
      <div class="text text-center text-md-left animated fadeInUp delay-0.5s">
        <h1>Analisa</h1>
        <p>Menampilkan Langkah - Langkah dalam pemrosesan Data menggunakan Metode PROMETHEE.</p>
        <div class="cta animated fadeInUp delay-1s" id="nav">
          <a class="btn btn-warning btn-md btn-icon icon-right" href="#analisa">Lanjut <i
              class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="image d-none d-lg-block animated fadeIn delay-1s">
        <img src="{{url('img/ill.svg')}}" alt="img">
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow rounded" id="analisa">
        <div class="card-header">
          <h2>Data Persebaran</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover table-md" id="LeavingEntering">
              <thead>
                <tr align="center">
                  {{-- <td>Alternatif</td> --}}
                      @for($a = 1; $a <= Kustom::CountAlternatifs(); $a++)
                        <td>A{{$a}}</td>
                      @endfor
                    </tr>
                  </thead>
                  <tbody align="center">
                    <tr>
                      @for($y = 0; $y < Kustom::CountAlternatifs(); $y++)
                        @for($x = 0; $x < Kustom::CountAlternatifs(); $x++)
                          {{-- <td>A</td> --}}
                          @if($x == $y)
                            <td><b>{{number_format($tip[$y][$x]['value'], 2)}}</b></td>
                          @else
                            <td>{{number_format($tip[$y][$x]['value'], 2)}}</td>
                          @endif
                        @endfor
                    </tr>
                      @endfor
                  </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow rounded">
        <div class="card-header">
          <h2>Ranking</h2>
        </div>
        <div class="card-body">
          <table width="100%" class="table table-striped table-bordered table-hover table-md" id="Net">
            <thead align="center">
              <tr>
                <th>Kecamatan</th>
                <th>Netflow</th>
              </tr>
            </thead>
            <tbody align="center">
              @php
                asort($arraynet);
                $no = 1;
              @endphp
              @foreach ($arraynet as $net => $value)
              <tr>
                <td>{{$value['kecamatan']}}</td>
                <td>{{number_format($value['net'], 2)}}</td>
              </tr>
              @php
                $no++;
              @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
