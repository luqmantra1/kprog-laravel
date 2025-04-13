@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      @include('_message')

      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Proposal List</h3>
        <a href="{{ url('panel/proposal/add') }}" class="btn btn-primary">Add Proposal</a>
      </div>

      <table class="table table-borderless">
        <thead>
          <tr>
            <th>#</th>
            <th>Client</th>
            <th>Title</th>
            <th>Submission Date</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($getRecord as $value)
          <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->client->company_name ?? 'N/A' }}</td>
            <td>{{ $value->proposal_title }}</td>
            <td>{{ $value->submission_date }}</td>
            <td>{{ ucfirst($value->status) }}</td>
            <td>{{ $value->created_at }}</td>
            <td>
              <a href="{{ url('panel/proposal/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
              <a href="{{ url('panel/proposal/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this proposal?')">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>

@endsection
