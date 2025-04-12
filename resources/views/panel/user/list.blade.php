@extends('panel.layout.app')

@section('content')

<!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="body-wrapper-inner">
        <div class="container-fluid">
        @include('_message')
        <div class="card-header border-0 d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">User List</h3>
                  <a href="{{ url('panel/user/add') }}" class="btn btn-primary">Add User</a>
                </div>
        <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($getRecord as $value)
                <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->role_name}}</td>
                <td>{{$value->created_at}}</td>
                <td>
                <a href ="{{ url('panel/user/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href ="{{ url('panel/user/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
    </table>
        </div>
      </div>
    </div>
@endsection