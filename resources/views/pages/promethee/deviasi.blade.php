@extends('layout.dashboard')

@section('content')
<div class="container">
    @section('pages','promethee')
    @section('title','deviasi')
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <td>No.</td>
                                <td>Kecamatan</td>
                                <td>Kecamatan</td>
                                <td>A</td>
                                <td>B</td>
                                <td>Kriteria</td>
                                <td>Nilai</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @foreach ($showdeviasi as $deviasi => $value)
                            @for ($x = 0; $x < Kustom::CountAlternatifs(); $x++)
                            @for ($y=0; $y < Kustom::CountAlternatifs(); $y++)
                            <tr align="center">
                                <td>{{$no++}}</td>
                                <td>{{$value[$x]->alternatif}}</td>
                                <td>{{$value[$y]->alternatif}}</td>
                                <td>{{$value[$x]->nilai}}</td>
                                <td>{{$value[$y]->nilai}}</td>
                                <td>{{$value[$y]->kriteria}}</td>
                                <td>{{($value[$x]->nilai)-($value[$y]->nilai)}}</td>
                            </tr>
                            @endfor
                            @endfor
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection