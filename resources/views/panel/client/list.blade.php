@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
  <h3>Client List</h3>
  <a href="{{ route('client.export') }}" class="btn btn-success mb-3">
  <i class="ti ti-download me-1"></i> Export to Excel
</a>
  @if(!empty($PermissionAdd))
    <a href="{{ url('panel/client/add') }}" class="btn btn-primary">Add Client</a>
  @endif
</div>


      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Company Name</th>
              <th>Contact Person</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Created At</th>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <th class="text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse ($getClient as $value)
            <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->company_name }}</td>
              <td>{{ $value->contact_person }}</td>
              <td>{{ $value->email }}</td>
              <td>{{ $value->phone }}</td>
              <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <td class="text-center">
              @if(!empty($PermissionEdit))
                <a href="{{ url('panel/client/edit/'.$value->id) }}" class="btn btn-sm btn-warning">Edit</a>
              @endif

              @if(!empty($PermissionDelete))
                <a href="{{ url('panel/client/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</a>
              @endif
            </td>
            @endif
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center">No clients found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>


@endsection
