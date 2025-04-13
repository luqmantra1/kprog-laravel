@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      @include('_message')
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Client List</h3>
        <a href="{{ url('panel/client/add') }}" class="btn btn-primary">Add Client</a>
      </div>

      <table class="table table-borderless">
        <thead>
          <tr>
            <th>#</th>
            <th>Company Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($getClient as $value)
          <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->company_name }}</td>
            <td>{{ $value->contact_person }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->phone }}</td>
            <td>{{ $value->created_at }}</td>
            <td>
              <a href="{{ url('panel/client/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
              <a href="{{ url('panel/client/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>
@endsection
