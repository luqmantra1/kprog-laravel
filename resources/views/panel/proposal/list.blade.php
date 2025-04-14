@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Proposal List</h3>
        <a href="{{ route('proposal.export') }}" class="btn btn-success mb-3">
          <i class="ti ti-download me-1"></i> Export to Excel
        </a>
        <!-- Show Add Proposal button only if the user has permission -->
        @if(!empty($PermissionAdd))
        <a href="{{ url('panel/proposal/add') }}" class="btn btn-primary">Add Proposal</a>
        @endif
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Client</th>
              <th scope="col">Title</th>
              <th scope="col">Submission Date</th>
              <th scope="col">Status</th>
              <th scope="col">Created At</th>
              <th scope="col">File</th> <!-- Added a column for the file link -->

              <!-- Show Action column only if the user has permission for Edit or Delete -->
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <th scope="col" class="text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($getRecord as $value)
            <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->client->company_name ?? 'N/A' }}</td>
              <td>{{ $value->proposal_title }}</td>
              <td>{{ \Carbon\Carbon::parse($value->submission_date)->format('d M Y') }}</td>
              <td>
                @php
                  $badgeClass = match($value->status) {
                    'draft' => 'secondary',
                    'submitted' => 'info',
                    'reviewed' => 'success',
                    default => 'dark',
                  };
                @endphp
                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($value->status) }}</span>
              </td>
              <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>

              <!-- Added file column with download or view link -->
              <td>
                @if($value->proposal_file)
                  <a href="{{ asset('public/storage/' . $value->proposal_file) }}" target="_blank" class="btn btn-sm btn-info">View Proposal</a>
                @else
                  No file uploaded
                @endif
              </td>

              <!-- Show action buttons based on permissions -->
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <td class="text-center">
                @if(!empty($PermissionEdit))
                <a href="{{ url('panel/proposal/edit/'.$value->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endif
                @if(!empty($PermissionDelete))
                <a href="{{ url('panel/proposal/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this proposal?')">Delete</a>
                @endif
              </td>
              @endif
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center">No proposals found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
