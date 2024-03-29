{{-- {{dd($alternatif)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','profile')
@section('title','setting profile')

<div class="container">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="row">
    <div class="col"></div>
    <div class="col-6">
      <div class="card shadow rounded">
        <div class="card-body">
          <form action="{{route('profile.update', $data->id)}}" method="POST" class="form">
            {{ csrf_field() }}
            <br>
            <div class="form-group">
              <h5 class="label-control">Username</h5>
              <input class="form-control" type="text" name="username" value="{{$data->username}}">
            </div>
            <div class="form-group">
              <h5 class="label-control">Alias</h5>
              <input class="form-control" type="text" name="alias" value="{{$data->alias}}">
            </div>
        <button class="btn btn-success btn-md" type="submit">Proses</button>
        </form>
      </div>
    </div>

  </div>
  <div class="col"></div>
</div>
</div>
@endsection