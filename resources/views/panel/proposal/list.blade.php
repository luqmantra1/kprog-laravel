@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Proposal List</h3>
        <a href="{{ url('panel/proposal/add') }}" class="btn btn-primary">Add Proposal</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Title</th>
              <th>Submission Date</th>
              <th>Status</th>
              <th>Created At</th>
              <th class="text-center">Actions</th>
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
              <td class="text-center">
                <a href="{{ url('panel/proposal/edit/'.$value->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ url('panel/proposal/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this proposal?')">Delete</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center">No proposals found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
