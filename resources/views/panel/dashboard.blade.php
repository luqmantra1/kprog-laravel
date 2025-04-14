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
                <li class="list-group-item">
                  <strong>John Doe</strong> added a new proposal.
                  <span class="badge bg-success float-end">Today</span>
                </li>
                <li class="list-group-item">
                  <strong>Jane Smith</strong> approved a new policy.
                  <span class="badge bg-warning float-end">Yesterday</span>
                </li>
                <li class="list-group-item">
                  <strong>Michael Brown</strong> updated a client record.
                  <span class="badge bg-danger float-end">2 days ago</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
