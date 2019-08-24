{{-- {{dd($alternatif)}} --}}
@extends('layout.dashboard')

@section('content')

@section('pages','users')
@section('title','edit')
<div class="row">
  <div class="col"></div>
  <div class="col-6">
    <div class="card shadow rounded">
      <div class="card-body">
        <form action="{{route('pengguna.update', $data->id)}}" method="POST" class="form">
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
          <div class="form-group mr-3">
            <h5 class="label-control">Role</h5>
            <select class="form-control select2" name="role" value="{{$data->role}}" required>
              <option value="Adminstrator">Adminstrator</option>
              <option value="Manager">Manager</option>
            </select>
          </div>
          <button class="btn btn-success btn-md" type="submit">Proses</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>
@endsection