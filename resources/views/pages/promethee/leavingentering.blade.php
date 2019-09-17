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
                  <td>Leaving</td>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                @for($y = 0; $y < Kustom::CountAlternatifs(); $y++)
                  @php $temp = null; @endphp
                  @for($x = 0; $x < Kustom::CountAlternatifs(); $x++)
                    @if($x == $y)
                      <td><b>{{number_format($tip[$y][$x]['value'], 2)}}</b></td>
                    @else
                      <td>{{number_format($tip[$y][$x]['value'], 2)}}</td>
                    @endif
                    @php $temp = $temp + $tip[$y][$x]['value']; @endphp
                  @endfor
                  @php
                  $temp = $temp / (Kustom::CountAlternatifs() - 1);
                  @endphp
                  <td style="background-color: #EEEEEE">{{number_format($temp, 2)}}</td>
              </tr>
                @endfor
              <tr>
                  @for($y = 0; $y < Kustom::CountAlternatifs(); $y++)
                  @php $temp = null; @endphp
                  @for($x = 0; $x < Kustom::CountAlternatifs(); $x++)
                    @php $temp = $temp + $tip[$x][$y]['value']; @endphp
                  @endfor
                  @php
                  $temp = $temp / (Kustom::CountAlternatifs() - 1);
                  @endphp
                  <td style="background-color: #EEEEEE">{{number_format($temp, 2)}}</td>
                  @endfor
                  <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection