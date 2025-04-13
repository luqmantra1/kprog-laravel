@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Roles</h3>
        @if(!empty($PermissionAdd))
        <a href="{{ url('panel/role/add') }}" class="btn btn-primary">Add Role</a>
        @endif
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Date Created</th>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <th scope="col" class="text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($getRecord as $value)
            <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <td class="text-center">
                @if(!empty($PermissionEdit))
                <a href="{{ url('panel/role/edit/'.$value->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endif
                @if(!empty($PermissionDelete))
                <a href="{{ url('panel/role/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">Delete</a>
                @endif
              </td>
              @endif
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center">No roles found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
