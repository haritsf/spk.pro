@extends('layout.dashboard')

@section('content')
<div class="container">
  @section('pages','promethee')
  @section('title','net flow')

  <div class="row">
    <div class="col-lg"></div>
    <div class="col-lg-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <table width="100%" class="table table-striped table-bordered table-hover table-md" id="Net">
            <thead>
              <tr align="center">
                <th>Netflow</th>
                <th>Kecamatan</th>
              </tr>
            </thead>
            <tbody>
              @php
                asort($arraynet);
              @endphp
              @foreach ($arraynet as $net => $value)
              <tr align="center">
                <td>{{number_format($value['net'], 2)}}</td>
                <td>{{$value['kecamatan']}}</td>
              </tr>
              @endforeach
            </tbody>
            </table>
        </div>
      </div>
    </div>
    <div class="col-lg"></div>
  </div>

</div>
@endsection