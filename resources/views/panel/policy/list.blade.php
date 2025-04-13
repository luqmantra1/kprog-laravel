@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Policies</h3>
        <a href="{{ url('panel/policy/add') }}" class="btn btn-primary">Add New Policy</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>Policy Number</th>
              <th>Status</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($policies as $policy)
              <tr>
                <td>{{ $policy->policy_number }}</td>
                <td>
                  <span class="badge bg-{{ 
                    $policy->status == 'active' ? 'success' : 
                    ($policy->status == 'expired' ? 'secondary' : 
                    ($policy->status == 'terminated' ? 'danger' : 'warning')
                  ) }}">
                    {{ ucfirst($policy->status) }}
                  </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($policy->start_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($policy->end_date)->format('d M Y') }}</td>
                <td class="text-center">
                  <a href="{{ url('panel/policy/edit/'.$policy->id) }}" class="btn btn-sm btn-warning">Edit</a>
                  <a href="{{ url('panel/policy/delete/'.$policy->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this policy?')">Delete</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No policies found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
