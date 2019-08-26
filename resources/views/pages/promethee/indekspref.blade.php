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
                                <td>X</td>
                                <td>Y</td>
                                <td>Tipe</td>
                                <td>q</td>
                                <td>p</td>
                                <td>Bobot</td>
                                <td>Deviasi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n = 0;
                            @endphp
                            @foreach ($showpreferensi as $show)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$show->alternatifx}}</td>
                                <td>{{$show->alternatify}}</td>
                                <td>{{$show->kriteria}}</td>
                                <td>{{$show->tipe}}</td>
                                <td>{{$show->q}}</td>
                                <td>{{$show->p}}</td>
                                <td>{{$show->bobot}}</td>
                                <td>{{$show->deviasi}}</td>
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