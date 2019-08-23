{{-- @php
dd($showpreferensi);
@endphp --}}

@extends('layout.dashboard')

@section('content')
<div class="container">
    @section('pages','promethee')
    @section('title','leaving flow')
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <td>No.</td>
                                <td>Kecamatan</td>
                                <td>Nilai Leaving</td>
                            </tr>
                        </thead>
                        <tbody>
                           {{-- @foreach ($showpreferensi as $show)
                            <td>{{$show->[0]}}</td>
                           @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection