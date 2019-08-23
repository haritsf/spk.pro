@extends('layout.client')

@section('content')

<div class="hero-wrapper">
    <div class="hero">
        <div class="container">
            <div class="text text-center text-lg-left animated fadeInUp delay-0.5s">
                <h1>Sistem Pendukung Keputusan</h1>
                <p>
                    promethee akan mempercepat kamu dalam mengambil keputusan, tentukan kasusmu dan klienmu akan
                    menyukainya.
                </p>
                <div class="cta animated fadeInUp delay-1s" id="nav"">
                    <a class=" btn btn-warning btn-md btn-icon icon-right" href="#stats">Lanjut <i
                        class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="image d-none d-lg-block animated fadeInUp delay-1s">
                <img src="{{url('img/ill.svg')}}" alt="img">
            </div>
        </div>
    </div>
</div>

<div class="callout container shadow rounded">
    <div class="row">
        <div class="col-md-6 col-12 mb-4 mb-lg-0">
            <div class="text-job text-muted text-14">not a reason to use promethee</div>
            <div class="h1 mb-0 font-weight-bold"><span class="font-weight-500">just a </span>statistic</div>
        </div>
        <div class="col-4 col-md-2 text-center" id="stats">
            <div class="h2 font-weight-bold">
                {{ $countalternatifs*$countkriterias }}
            </div>
            <div class="text-uppercase font-weight-bold ls-2 text-primary">Evaluations</div>
        </div>
        <div class="col-4 col-md-2 text-center">
            <div class="h2 font-weight-bold">
                {{ $countalternatifs }}
            </div>
            <div class="text-uppercase font-weight-bold ls-2 text-primary">Alternatifs</div>
        </div>
        <div class="col-4 col-md-2 text-center">
            <div class="h2 font-weight-bold">
                {{ $countkriterias }}
            </div>
            <div class="text-uppercase font-weight-bold ls-2 text-primary">Kriterias</div>
        </div>
    </div>
</div>
<section id="features">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-lg-10 offset-lg-1">
                <h2>promethee <span class="text-primary">dirancang untuk kamu</span> dan klienmu</h2>
                <p class="lead">Terintegrasi dengan {{ $countalternatifs }} Kecamatan dan memiliki banyak Evaluasi,<br>
                    Kamu akan dimudahkan dalam menentukan Keputusan.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="features shadow rounded">
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5>Responsive Design</h5>
                        <p>Don't worry about the gadget you have. Stisla is very suitable for every platform.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fab fa-html5"></i>
                        </div>
                        <h5>HTML5 &amp; CSS3</h5>
                        <p>Written with HTML5 and CSS3 and supported by most modern browsers.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h5>JavaScript APIs</h5>
                        <p>We provide some javascript APIs to interact with some components more easily.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <h5>Verified By W3C?</h5>
                        <p>All HTML pages are free of errors, because they have been verified by W3C.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-columns"></i>
                        </div>
                        <h5>Bootstrap 4</h5>
                        <p>Based on Bootstrap 4, one of the popular flexbox frameworks.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                        <h5>And Others</h5>
                        <p>We don't want to talk much about this template, try it yourself and don't say anything.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="design" class="section-design">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{url('img/undraw_processing_qj6a.svg')}}" alt="user flow" class="img-fluid">
            </div>
            <div class="col-lg-7 pl-lg-5 col-md-12">
                <div class="badge badge-primary mb-3">30+ third-party libraries</div>
                <h2>Save your time for other <span class="text-primary">important things</span>, not <span
                        class="text-primary">dashboard</span> design</h2>
                <p class="lead">Your idea has other things that need to be prioritized, don't waste your time only
                    on the dashboard design. Stisla will speed up your project to design a clean dashboard
                    interface.</p>
                <div class="mt-4">
                    <a href="" class="link-icon">
                        Getting Started with Stisla <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="download-section" class="bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h2>Start Your Awesome Project</h2>
                <p class="lead">Start your amazing project with Stisla, don't start designing from scratch.</p>
            </div>
            <div class="col-md-5 text-right">
                <a href="https://getstisla.com/download" class="btn btn-primary btn-lg">Download Stisla Now</a>
            </div>
        </div>
    </div>
</section>

<section class="before-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-body d-flex p-45">
                        <div class="card-icon bg-primary text-white">
                            <i class="far fa-file"></i>
                        </div>
                        <div>
                            <h5>Explore The Docs</h5>
                            <p class="lh-sm">Find out how to use Stisla, find out how to make Cards, Navbar, Tables,
                                Maps and so on. Find out everything in the documentation.</p>
                            <div class="mt-4 text-right">
                                <a href="https://getstisla.com/docs" class="link-icon">Documentation <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-body p-45 d-flex">
                        <div class="card-icon bg-primary text-white">
                            <i class="far fa-life-ring"></i>
                        </div>
                        <div>
                            <h5>Support</h5>
                            <p class="lh-sm">Lifetime support as long as you use Stisla. Get support for Stisla bugs
                                or request features through the Stisla community on the GitHub issue.</p>
                            <div class="mt-4 text-right">
                                <a href="https://getstisla.com/support" class="link-icon">Support <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection