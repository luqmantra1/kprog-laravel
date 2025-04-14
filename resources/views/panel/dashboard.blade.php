@extends('panel.layout.app')

@section('content')

<!-- Main wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      @include('panel.layout.header')

      <!-- Statistics + Recent Activity Section -->
<div class="row mb-3">
  <!-- Statistics Cards -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-body">
        <h5 class="card-title text-muted">Total Clients</h5>
        <h3 class="text-primary">{{ $totalClients }}</h3>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-body">
        <h5 class="card-title text-muted">Total Proposals</h5>
        <h3 class="text-primary">{{ $totalProposals }}</h3>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-body">
        <h5 class="card-title text-muted">Total Policies</h5>
        <h3 class="text-primary">{{ $totalPolicies }}</h3>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-body">
        <h5 class="card-title text-muted">Total Quotations</h5>
        <h3 class="text-primary">{{ $totalQuotations }}</h3>
      </div>
    </div>
  </div>
</div>

<!-- Recent Activity Section -->
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-body">
        <h5 class="card-title mb-3">🧾 Recent Activity</h5>
        <div class="table-responsive" style="height: 380px;">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th class="text-end">Time</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($recentActivities as $activity)
                <tr>
                  <td><strong>{{ $activity->user->name ?? 'Unknown User' }}</strong></td>
                  <td>
                    <span class="badge 
                      @if (str_contains($activity->action, 'created')) bg-success
                      @elseif (str_contains($activity->action, 'updated')) bg-warning text-dark
                      @elseif (str_contains($activity->action, 'deleted')) bg-danger
                      @else bg-secondary
                      @endif">
                      {{ ucfirst($activity->action) }}
                    </span>
                  </td>
                  <td>{{ $activity->description }}</td>
                  <td class="text-end text-muted">
                    <i class="bi bi-clock me-1"></i>{{ $activity->created_at->diffForHumans() }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-muted text-center">No recent activity found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
