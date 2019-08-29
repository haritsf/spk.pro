@php
// dd($tip);
// dd($tip[0][0]['value']);
@endphp
@extends('layout.dashboard')

@section('content')
<div class="container">
  @section('pages','promethee')
  @section('title','leaving & entering flow')
  <div class="row">
    <div class="col-12">
      <div class="card shadow rounded">
        <div class="card-body">
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
</div>
@endsection