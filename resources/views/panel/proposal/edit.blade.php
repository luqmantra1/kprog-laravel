@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      <h3>Edit Proposal</h3>

      <form method="POST" action="{{ url('panel/proposal/update/'.$getRecord->id) }}">
        @csrf

        <div class="mb-3">
          <label>Client</label>
          <select name="client_id" class="form-control" required>
            <option value="">Select Client</option>
            @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $getRecord->client_id == $client->id ? 'selected' : '' }}>
              {{ $client->company_name }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
        <label>Proposal Title</label>
        <select name="proposal_title" class="form-control" required>
            <option value="Select" {{ $getRecord->proposal_title == 'Select' ? 'selected' : '' }}>Select</option>
            <option value="Life Insurance" {{ $getRecord->proposal_title == 'Life Insurance' ? 'selected' : '' }}>Life Insurance</option>
            <option value="Health Insurance" {{ $getRecord->proposal_title == 'Health Insurance' ? 'selected' : '' }}>Health Insurance</option>
            <option value="Motor Insurance" {{ $getRecord->proposal_title == 'Motor Insurance' ? 'selected' : '' }}>Motor Insurance</option>
            <option value="Home Insurance" {{ $getRecord->proposal_title == 'Home Insurance' ? 'selected' : '' }}>Home Insurance</option>
            <option value="Travel Insurance" {{ $getRecord->proposal_title == 'Travel Insurance' ? 'selected' : '' }}>Travel Insurance</option>
            <option value="Disability Insurance" {{ $getRecord->proposal_title == 'Disability Insurance' ? 'selected' : '' }}>Disability Insurance</option>
            <option value="Business Insurance" {{ $getRecord->proposal_title == 'Business Insurance' ? 'selected' : '' }}>Business Insurance</option>
            <option value="Marine Insurance" {{ $getRecord->proposal_title == 'Marine Insurance' ? 'selected' : '' }}>Marine Insurance</option>
        </select>
        </div>


        <div class="mb-3">
          <label>Submission Date</label>
          <input type="date" name="submission_date" class="form-control" value="{{ $getRecord->submission_date }}" required>
        </div>

        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control" required>
            <option value="draft" {{ $getRecord->status == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="submitted" {{ $getRecord->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
            <option value="reviewed" {{ $getRecord->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
          </select>
        </div>

        <button class="btn btn-success">Update</button>
      </form>

    </div>
  </div>
</div>

@endsection
