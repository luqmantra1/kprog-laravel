@extends('panel.layout.app')

@section('content')

@php
  use Illuminate\Support\Facades\Auth;
  $user = Auth::user();
@endphp

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Policies</h3>
        <a href="{{ route('policy.export') }}" class="btn btn-success mb-3">
  <i class="ti ti-download me-1"></i> Export to Excel
</a>
        {{-- Add Policy button (Only if permission exists) --}}
        @if(!empty($PermissionAdd))
          <a href="{{ url('panel/policy/add') }}" class="btn btn-primary">Add New Policy</a>
        @endif
      </div>

      <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Client</th>
                <th>Quotation Number</th>
                <th>Policy Number</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>File</th>
                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                    <th class="text-center">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($getRecord as $policy)
                <tr>
                    <td>{{ $policy->quotation->client->company_name ?? 'N/A' }}</td> <!-- Display Client Name -->
                    <td>{{ $policy->quotation->quotation_number }}</td> <!-- Display Quotation Number -->
                    <td>{{ $policy->policy_number }}</td>
                    <td>
                        <span class="badge bg-{{
                            $policy->status == 'active' ? 'success' :
                            ($policy->status == 'expired' ? 'secondary' :
                            ($policy->status == 'terminated' ? 'danger' : 'warning'))
                        }}">
                            {{ ucfirst($policy->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($policy->start_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($policy->end_date)->format('d M Y') }}</td>

                    {{-- ✅ File View Button --}}
                    <td>
                        @if($policy->policy_file)
                            <a href="{{ asset('public/storage/' . $policy->policy_file) }}" target="_blank" class="btn btn-sm btn-info">
                                View File
                            </a>
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>

                    @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                        <td class="text-center">
                            {{-- Edit button --}}
                            @if(!empty($PermissionEdit))
                                <a href="{{ url('panel/policy/edit/'.$policy->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endif

                            {{-- Delete button --}}
                            @if(!empty($PermissionDelete))
                                <a href="{{ url('panel/policy/delete/'.$policy->id) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this policy?')">Delete</a>
                            @endif

                            {{-- No actions available --}}
                            @if(empty($PermissionEdit) && empty($PermissionDelete))
                                <span class="text-muted">No Actions</span>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No policies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    </div>
  </div>
</div>

@endsection
