@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">User List</h3>
        <a href="{{ url('panel/user/add') }}" class="btn btn-primary">Add User</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Date Created</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($getRecord as $value)
            <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->email }}</td>
              <td>{{ ucfirst($value->role_name) }}</td>
              <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
              <td class="text-center">
                <a href="{{ url('panel/user/edit/'.$value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('panel/user/delete/'.$value->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">No users found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
