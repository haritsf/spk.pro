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
          @php
          asort($arraynet);
          $no = 1;
          @endphp
          <table width="100%" class="table table-striped table-bordered table-hover table-md" id="totalPref">
            <thead>
              <tr>
                {{-- <th>
                                    <center>Ranking</center>
                                </th>
                                <th>
                                    <center>Kecamatan</center>
                                </th> --}}
                <th>
                  <center>Netflow</center>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($arraynet as $net => $value)
                <tr align="center">
                  <td>{{number_format($value, 2)}}</td>
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