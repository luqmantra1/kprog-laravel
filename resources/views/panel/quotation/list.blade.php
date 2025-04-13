@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      @include('_message')
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Quotation List</h3>
        <a href="{{ url('panel/quotation/add') }}" class="btn btn-primary">Add Quotation</a>
      </div>
      <table class="table table-borderless">
        <thead>
          <tr>
            <th>#</th>
            <th>Client</th>
            <th>Proposal Title</th>
            <th>Insurance Company</th>
            <th>Quotation Number</th>
            <th>Amount (RM)</th>
            <th>Status</th>
            <th>Acceptance Status</th>
            <th>Policy Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($getRecord as $quotation)
          <tr>
          
            <td>{{ $quotation->id }}</td>
            <td>{{ $quotation->proposal->client->company_name ?? 'N/A' }}</td>
            <td>{{ $quotation->proposal->proposal_title }}</td>
            <td>{{ $quotation->insurance_company }}</td>
            <td>{{ $quotation->quotation_number }}</td>
            <td>{{ $quotation->amount }}</td>
            <td>{{ ucfirst($quotation->status) }}</td>
            <td>{{ ucfirst($quotation->acceptance_status) }}</td>
            <td>{{ ucfirst($quotation->policy_status) }}</td>
            <td>{{ $quotation->created_at }}</td>
            <td>
              <a href="{{ url('panel/quotation/edit/'.$quotation->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <a href="{{ url('panel/quotation/delete/'.$quotation->id) }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
