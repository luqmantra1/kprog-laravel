@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      @include('_message')

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Quotation List</h3>
        <a href="{{ route('quotation.export') }}" class="btn btn-success mb-3">
  <i class="ti ti-download me-1"></i> Export to Excel
</a>
@if(!empty($PermissionAdd))
        <a href="{{ url('panel/quotation/add') }}" class="btn btn-primary">Add Quotation</a>
        @endif
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Proposal Title</th>
              <th>Insurance Company</th>
              <th>Quotation No.</th>
              <th>Amount (RM)</th>
              <th>Status</th>
              <th>Acceptance</th>
              <th>Policy Status</th>
              <th>Date</th>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <th class="text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($getRecord as $quotation)
            <tr>
              <td>{{ $quotation->id }}</td>
              <td>{{ $quotation->proposal->client->company_name ?? 'N/A' }}</td>
              <td>{{ $quotation->proposal->proposal_title ?? 'No Proposal Title' }}</td>
              <td>{{ $quotation->insurance_company }}</td>
              <td>{{ $quotation->quotation_number }}</td>
              <td>RM {{ number_format($quotation->amount, 2) }}</td>
              
              {{-- Status Badge --}}
              <td>
                @php
                  $statusBadge = match($quotation->status) {
                    'draft' => 'secondary',
                    'sent' => 'info',
                    'under_review' => 'warning',
                    'approved' => 'success',
                    default => 'dark'
                  };
                @endphp
                <span class="badge bg-{{ $statusBadge }}">{{ ucfirst($quotation->status) }}</span>
              </td>

              {{-- Acceptance Status Badge --}}
              <td>
                @php
                  $acceptanceBadge = match($quotation->acceptance_status) {
                    'accepted' => 'success',
                    'declined' => 'danger',
                    'awaiting' => 'warning',
                    default => 'secondary'
                  };
                @endphp
                <span class="badge bg-{{ $acceptanceBadge }}">{{ ucfirst($quotation->acceptance_status) }}</span>
              </td>

              {{-- Policy Status Badge --}}
              <td>
                @php
                  $policyBadge = match($quotation->policy_status) {
                    'active' => 'success',
                    'expired' => 'secondary',
                    'cancelled' => 'danger',
                    'terminated' => 'warning',
                    default => 'dark'
                  };
                @endphp
                <span class="badge bg-{{ $policyBadge }}">{{ ucfirst($quotation->policy_status) }}</span>
              </td>

              <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d M Y') }}</td>
              @if(!empty($PermissionEdit) || !empty($PermissionDelete))
              <td class="text-center">
              @if(!empty($PermissionEdit))
                <a href="{{ url('panel/quotation/edit/'.$quotation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endif
                @if(!empty($PermissionDelete))
                <a href="{{ url('panel/quotation/delete/'.$quotation->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this quotation?')">Delete</a>
                @endif
              </td>
              @endif
            </tr>
            @empty
            <tr>
              <td colspan="11" class="text-center">No quotations available.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@endsection
