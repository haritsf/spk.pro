@extends('layout.dashboard')
@section('content')
<div class="content-wrapper">
    @section('pages','map')
    @section('title','pemalang')
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow rounded">
                        <iframe width="100%" height="720" frameborder="0"
                            src="https://haritsf.carto.com/builder/fa5de34c-50bb-4906-9ce0-6de4809fb349/embed"
                            allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen
                            msallowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection