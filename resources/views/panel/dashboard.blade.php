@extends('panel.layout.app')

@section('content')

<!-- Main wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      @include('panel.layout.header')

      <div class="row">
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

      <!-- Recent Activity Feed (if you want it) -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card shadow-sm border-0 rounded">
            <div class="card-body">
            <h5 class="card-title">Recent Activity</h5>
<ul class="list-group">
    @forelse ($recentActivities as $activity)
        <li class="list-group-item">
            <strong>{{ $activity->user->name ?? 'Unknown User' }}</strong>
            {{ $activity->action }} –
            <small>{{ $activity->description }}</small>
            <span class="badge bg-secondary float-end">{{ $activity->created_at->diffForHumans() }}</span>
        </li>
    @empty
        <li class="list-group-item text-muted">No recent activity</li>
    @endforelse
</ul>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
