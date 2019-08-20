@extends('layout.dashboard')
@section('content')
<div class="container">
    @section('pages','view')
    @section('title','user')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered table-hover table-md" id="DataTables">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>USERNAME</th>
                                <th>PASSWORD</th>
                                <th>ALIAS</th>
                                <th>ROLE</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($getpenggunas as $data)
                            {{-- @section('title',$data->id) --}}
                            <tr align="center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->username }}</td>
                                <td id="password" type="password" name="password">{{ $data->password }}</td>
                                <td>{{ $data->alias }}</td>
                                <td>{{ $data->role }}</td>
                                <td>
                                    <a class="btn btn-warning btn-md" href="#"
                                        id="swal-6">Edit</a>
                                    {{-- <a class="btn btn-danger btn-md" href="{{url('/deletekecamatan/'.$data->id)}}"
                                        id="swal-6">Delete</a> --}}
                                </td>
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