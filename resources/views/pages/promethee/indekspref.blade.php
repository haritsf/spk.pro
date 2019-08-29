@php
// dd($showpreferensi);
@endphp

@extends('layout.dashboard')

@section('content')
<div class="container">
    @section('pages','promethee')
    @section('title','indeks preferensi')
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
                                <td>Kriteria</td>
                                <td>Tipe</td>
                                <td>Preferensi</td>
                                <td>Indeks Preferensi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n = 0;
                            @endphp
                            @foreach ($pref as $show => $value)
                            <tr align="center">
                                <td>{{$n++}}</td>
                                <td>{{$value['altx']}}</td>
                                <td>{{$value['alty']}}</td>
                                <td>{{$value['kriteria']}}</td>
                                <td>{{$value['tipe']}}</td>
                                <td>{{number_format($value['nilai'],2)}}</td>
                                <td>{{number_format($value['ip'],2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header"><h2>Total Indeks Preferensi</h2></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover table-md" id="Tables">
                            <thead>
                                <tr align="center">
                                    <td>No.</td>
                                    <td>Kecamatan</td>
                                    <td>Kecamatan</td>
                                    <td>Total Indeks Preferensi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $n = 0;
                                @endphp
                                @foreach ($tip as $show => $value)
                                <tr align="center">
                                    <td>{{$n++}}</td>
                                    <td>{{$value['altx']}}</td>
                                    <td>{{$value['alty']}}</td>
                                    <td>{{number_format($value['value'], 2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection