@extends('layout.client')
@section('content')
<div class="hero-wrapper">
    <div class="hero">
        <div class="container">
            <div class="text text-center text-md-left animated fadeInUp delay-0.5s">
                <h1>Pemalang</h1>
                <p>Menampilkan Kecamatan - Kecamatan yang ada di Kabupeten Pemalang, Jawa Tengah.</p>
                <div class="cta animated fadeInUp delay-1s" id="nav">
                    <a class="btn btn-warning btn-md btn-icon icon-right" href="#maps">Lanjut <i class="fas fa-chevron-right"></i></a>
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
                <div class="card shadow rounded" id="maps">
                    <iframe width="100%" height="720" frameborder="0"
                        src="https://haritsf.carto.com/builder/fa5de34c-50bb-4906-9ce0-6de4809fb349/embed"
                        allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen
                        msallowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection