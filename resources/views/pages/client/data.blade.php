@extends('layout.client')

@section('content')

<div class="hero-wrapper">
    <div class="hero">
        <div class="container">
            <div class="text text-center text-md-left animated fadeInUp delay-0.5s">
                <h1>Data</h1>
                <p>Menampilkan variabel - variabel kecamatan, kriteria, dan preferensi yang digunakan dalam pengolahan
                    data.</p>
                <div class="cta animated fadeInUp delay-1s" id="nav">
                    <a class="btn btn-warning btn-md btn-icon icon-right" href="#evals">Lanjut <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="image d-none d-lg-block animated fadeIn delay-1s">
                <img src="{{url('img/ill.svg')}}" alt="img">
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h2>Evaluasi</h2>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12" id="evals">
                            <table id="DataTables" width="100%" class="table table-striped table-bordered table-hover table-md">
                                <thead>
                                    <tr align="center" style="text-transform:lowercase">
                                        <th>Kecamatan</th>
                                        @foreach ($datas['kriterias'] as $kriteria)
                                        <th>{{$kriteria->nama}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    for ($id=1; $id <= Kustom::CountAlternatifs(); $id++) { 
                                        echo '<tr align="center">';
                                        echo '<td align="left">'.$datas['alternatifs'][$id-1]['nama'].'</td>';
                                        $getevals = Kustom::JoinanTabel($id);
                                        foreach ($getevals as $evals) {
                                            echo '<td>' .$evals->nilai.'</td>';
                                        }
                                        echo '</tr>';
                                        }
                                    @endphp
                                    {{-- @php
                                    for ($id=1; $id <= Kustom::CountAlternatifs(); $id++) { 
                                        echo '<tr align="center">';
                                        echo '<td align="left">'.$datas['alternatifs'][$id-1]['nama'].'</td>';
                                        $getevals = Kustom::JoinanTabel($id);
                                        foreach ($getevals as $evals) {
                                            foreach ($datas['klasifikasis'] as $data) {
                                                if ($evals->kriteria == $data->kriteria){
                                                    echo '<td>' .$data->klasifikasi.'</td>';
                                                }
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                    @endphp --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p>Data - Data Kecamatan beserta Nilai di setiap Kriteria</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h2>Kriteria</h2>
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-striped table-bordered table-hover table-md">
                            <thead>
                                <tr align="center" style="text-transform:lowercase">
                                    <th>ID</th>
                                    <th>NAMA</th>
                                    <th>PARAMETER</th>
                                    <th>TIPE</th>
                                    <th>q</th>
                                    <th>p</th>
                                    <th>BOBOT</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($datas['kriterias'] as $data)
                                <tr align="center">
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->minmaks }}</td>
                                    @foreach ($datas['prefs'] as $pref)
                                        @if ($data->pref == $pref->id)
                                            <td>{{ $pref->nama }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $data->q }}</td>
                                    <td>{{ $data->p }}</td>
                                    <td>{{ $data->bobot . '%' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <p>Data - Data Kriteria beserta Nilai di setiap Parameternya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection