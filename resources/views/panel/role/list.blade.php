@extends('panel.layout.app')

@section('content')

<!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="body-wrapper-inner">
        <div class="container-fluid">
        @include('_message')
        <div class="card-header border-0 d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">Roles</h3>
                  <a href="{{ url('panel/role/add') }}" class="btn btn-primary">Add Role</a>
                </div>
        <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getRecord as $value)
                <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>{{$value->created_at}}</td>
                <td>
                <a href ="{{ url('panel/role/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href ="{{ url('panel/role/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
    </table>
        </div>
      </div>
    </div>
@endsection